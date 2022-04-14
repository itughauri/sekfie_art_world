<?php

namespace App\Http\Controllers;

use App\Models\EntryRecord;
use Illuminate\Http\Request;
use App\Models\Session;
use TCPDF;

class EntryRecordController extends Controller
{
    public function index()
    {
        return view('entry_records.index',[
            'entry_records'  => EntryRecord::with('qr', 'customer', 'session')->get(),
            'session'        => Session::all()
        ]);
    }

    public function edit($id)
    {
        $record = EntryRecord::find($id);

        return view('entry_records.edit',[
            'record'  => $record,
            'session' => Session::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $entry = EntryRecord::with('qr','session', 'customer')->get();
        // return $request;
        $record = EntryRecord::find($id);
        $record->customer_id   = $request->customer_name;
        $record->session_id    = $request->session_id;
        $record->save();

        return redirect('entry_records')->with('update', 'Record Updated Successfully');
    }

    public function delete(Request $request)
    {
        $id = $request->record_id;
        EntryRecord::destroy($id);
        return redirect()->back()->with('delete', 'Record Deleted successfully');
    }

    public function orderby_date(Request $request)
    {
        $date = $request->date;
        $entry = EntryRecord::with('qr', 'customer', 'session')
        ->where('date', $date)
        ->get();
        return $entry;
    }

    public function orderby_session(Request $request)
    {
        $session = $request->session;
        $date = $request->date;
        $entry = EntryRecord::with('qr', 'session', 'customer')
        ->where('session_id', $session)
        ->where('date', $date)
        ->orderBy('id', 'desc')
        ->get();
        return $entry;
    }
    public function entry_pdf()
    {
        // $details = SessionDetails::all();

        include('tcpdf/tcpdf.php');

        // include('tcpdf/config/tcpdf_config.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // $pdf->Cell(190,10,"this is a cell",1,1, 'C');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('OK');
        $pdf->SetTitle('Entry Records');
        $pdf->SetSubject('TCPDF Tutorial');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set some language-dependent strings (optional)
        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }
        $pdf->setFontSubsetting(true);

        $pdf->SetFont('dejavusans', '', 14, '', true);

        $pdf->AddPage();

        $html = '';

        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

        $pdf->setFont('Helvetica', '', 14);
        $pdf->Cell(190, 10, "Selfie Art", 0, 1, 'C');

        $pdf->setFont('Helvetica', '', 14);
        $pdf->Cell(190, 5, "Entry Records", 0, 1, 'C');
        $pdf->Ln();
        $pdf->Ln(3);

        $html = "
            <table>
                <tr>
                    <th>QR</th>
                    <th>Name</th>
                    <th>Session</th>
                    <th>Date</th>
                </tr>";
        $details = EntryRecord::with('qr', 'customer', 'session')->get();
            foreach($details as $item){
        $html .= "
                <tr>
                    <td>". $item->qr->id ."</td>
                    <td>". $item->customer->name."</td>
                    <td>". $item->session->name ."</td>
                    <td>". $item->date ."</td>
                </tr>";
            }
        $html .= "
            </table>
            <style>
                table {
                    border-collapse:collapse;
                }
                th,td {
                    border: 1px solid #000;
                }
                table tr th {
                    background-color: #808080;
                    color: #fff;
                    font-weight: bold;
                }
            </style>
        ";

        $pdf->WriteHTMLCell(192, 0, 9, '', $html, 0);

        $pdf->Output('Entry_Records.pdf', 'I');
    }

}
