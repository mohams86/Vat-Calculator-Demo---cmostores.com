<?php
namespace App\Controller;

use App\Entity\VatCalculationHistory;
use App\Form\VatCalculatorFormType;
use App\Repository\VatCalculationHistoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VatCalculatorController extends AbstractController
{
    private $em;
    private $vatCalculationHistoryRepository;
    public function __construct(EntityManagerInterface $em, VatCalculationHistoryRepository $vatCalculationHistoryRepository) 
    {
        $this->em = $em;
        $this->vatCalculationHistoryRepository = $vatCalculationHistoryRepository;        
    }

    //Added below for Vat Calculation History listing page
    #[Route('/vatcalculationhistory', name: 'vatcalculationhistory')]
    public function index(): Response
    {
        $vatCalculationHistoryData = $this->vatCalculationHistoryRepository->findAll();
        return $this->render('vatcalculationhistory.html.twig', [
            'vatcalculationhistory' => $vatCalculationHistoryData
        ]);
    }
    
    //Added below for Vat Calculator page
    #[Route('/vatcalculator', name: 'vatcalculator')]
    public function displayVatCalculator(Request $request): Response
    {
        $vatCalculationEntity = new VatCalculationHistory();
        $form = $this->createForm(VatCalculatorFormType::class, $vatCalculationEntity);
        $form->handleRequest($request);        
        if ($form->isSubmitted() && $form->isValid()) {
            $vatCalculatorData = $form->getData();
            $userAmount = $form->get('user_input_amount')->getData();
            $vatOperation = $form->get('vat_operation')->getData();     
            $vatRate = $form->get('vat_rate')->getData();       
            if($vatOperation == 'add_vat') {                
                $calculatedVatAmount = $userAmount * ($vatRate / 100);                
                $includingVatAmount = $userAmount + $calculatedVatAmount;                
                $vatCalculatorData->setIncludingVatAmount($includingVatAmount);                
                $vatCalculatorData->setExcludingVatAmount($userAmount);
                $vatCalculatorData->setVatAmount($calculatedVatAmount);
            } else {
                $vatRate = '1.'.$vatRate;
                $vatAmount = round($userAmount / ($vatRate),2);
                $calculatedVatAmount = round($userAmount - $vatAmount,2);
                $vatCalculatorData->setExcludingVatAmount($vatAmount);
                $vatCalculatorData->setIncludingVatAmount($userAmount);
                $vatCalculatorData->setVatAmount($calculatedVatAmount);
            }

            $this->em->persist($vatCalculatorData);
            $this->em->flush();
            return $this->redirectToRoute('vatcalculationhistory');
        }        
        return $this->render('vatcalculator.html.twig', array( 
            'form' => $form->createView(), 
        ));        
    }

    //Added below for Deletion of Vat Calculation History data from database table
    #[Route('/vatcalculator/deletehistory', name: 'vatcalculation_delete_history')]
    public function delete(): Response
    {
        $query = $this->vatCalculationHistoryRepository->createQueryBuilder('e')
            ->delete()
            ->getQuery()
            ->execute();        
        $this->em->flush();
        return $this->redirectToRoute('vatcalculator');
    }

    //Added below for exporting Vat Calculation History data in csv file 
    #[Route('/vatcalculator/exporthistorydata', name: 'vatcalculation_export_history')]
    public function exportHistoryData(): Response
    {     
        $results = $this->vatCalculationHistoryRepository->findAll();
        $response = new StreamedResponse();
        $response->setCallback(
            function () use ($results) {
                $handle = fopen('php://output', 'r+');
                fputcsv($handle, [
                    'ID',
                    'User Amount',
                    'Vat Rate (%)',
                    'Gross Amount (Inclusive of VAT)',
                    'Net Amount (Exclusive of VAT)',
                    'Total Vat'                    
                ]);
                foreach ($results as $row) {
                    //array list fields you need to export
                    $data = array(
                        $row->getId(),
                        $row->getUserInputAmount(),
                        $row->getVatRate(),
                        $row->getIncludingVatAmount(),
                        $row->getExcludingVatAmount(),
                        $row->getVatAmount()                      
                    );
                    fputcsv($handle, $data);
                }
                fclose($handle);
            }
        );
        $response->headers->set('Content-Type', 'application/force-download');
        $response->headers->set('Content-Disposition', 'attachment; filename="export_vatcalculation_data.csv"');
        return $response;
    }
}
?>