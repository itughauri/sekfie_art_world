<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\SessionDetails;
use App\Models\Session;
use App\Models\Qrs;
use Illuminate\Support\Facades\DB;
use TCPDF;

class BookingController extends Controller
{
    public function index()
    {
        // return $date = date('H-i-s');
        return view('booking.index', [
            'sessions'  => Session::get()
        ]);
    }

    public function create(Request $request)
    {
        $exists = Customer::where('cnic', $request->cnic)->orWhere('contact_no', $request->contact)->count();
        if ($exists > 0) {
            return [
                'success' => false,
                'message' => 'Customer already exists'
            ];
        }

        Customer::create([
            'name'       => $request->name,
            'gender'     => $request->gender,
            'cnic'       => $request->cnic,
            'contact_no' => $request->contact_no,
            'age'        => $request->age,
            'email'      => $request->email
        ]);

        return [
            'success' => true,
            'message' => 'Customer successfully added'
        ];
    }

    public function find(Request $request)
    {

        if ($customer = Customer::where('cnic', $request->queryData)->orWhere('contact_no', $request->queryData)->first()) {
            return [
                'success'  => true,
                'customer' => $customer
            ];
        } else {
            return [
                'failed' => true,
                'customer' => 'not existed'
            ];
        }
    }

    public function remainingTickets(Request $request)
    {
        $session = SessionDetails::where('session_id', $request->queryData)->where('date', $request->date)->count();
        return [
            'success' => true,
            'sessionTickets' => $session
        ];
    }

    public function allotted(Request $request)
    {
        $qr = Qrs::where('id', $request->queryData)->first();
        if ($qr->allotted == '1') {
            return [
                'success' => false,
                'message' => 'This QR code is already allotted'
            ];
        }
    }

    public function store(Request $request)
    {

        $request->validate([
            'date'  => 'required',
        ]);

        $sessionCount = SessionDetails::where('session_id', $request->session)->count();
        for ($i = 0; $i < $request->no_of_tickets; $i++) {
            if ($sessionCount  != 200) {
                SessionDetails::create([
                    'customer_id' => $request->customer_id,
                    'session_id'  => $request->session,
                    'qr_id'       => '0',
                    'date'        => $request->date,
                    'status'      => 'manual booked',
                    'socks'       => '0'
                ]);
            }
        }
        return redirect()->back()->with('message', 'Ticket Booked successfully');
    }

    public function view()
    {
        $records  = Customer::join('session_tickets', 'customers.id', 'session_tickets.customer_id')
            ->join('sessions', 'session_tickets.session_id', 'sessions.id')
            ->where('status', '=', 'manual booked')
            ->where('qr_id', '=', '0')
            ->select('customers.name', 'sessions.to', 'sessions.from' , 'sessions.id as session_id', 'sessions.name as session', 'customers.cnic', 'customers.contact_no', 'customers.id as customers_id', 'session_tickets.id', 'session_tickets.qr_id', 'session_tickets.status', 'session_tickets.date', DB::raw('count(customer_id) as customer_id'))
            ->groupBy('customer_id')
            ->orderBy('id', 'desc')
            ->get();
        return view('booking.view', [
            'records'  => $records,
            'session'  => Session::all()
        ]);
    }

    public function multiple_assign(Request $request)
    {

        foreach ($request->qr_code as $index => $qr) {
           $exist =  Qrs::where('id', $qr)->where('allotted', '0')->get();

           if ( $exist->count() > 0 ) {
                Qrs::find($qr)->update([
                    'allotted' => '1'
                ]);

                SessionDetails::where('id' , $request->session_tickets[$index])->update([
                    'status' => 'sold',
                    'qr_id'  => $qr
                ]);

            } else {
                return redirect()->back()->with('allotted', 'QR already  allotted');
            }
        }
        return redirect()->back()->with('sold', 'Ticket Sold Successfully');
    }

    public function no_of_tickets(Request $request)
    {
        $customer_id = $request->customer_id;

        $details = SessionDetails::where('customer_id', $customer_id)
        ->where('session_id', $request->session)->where('date', $request->date)
        ->where('status', 'manual booked')
        ->get();

        return $details;
    }

    public function del_all_sessions(Request $request)
    {
        $date = $request->date;
        $session = $request->session;

        if ($del_sessions = SessionDetails::where('session_id', $session)->where('date', $date)->delete()) {
            return [
                'success' => true,
                'message' => 'Bookings deleted successfully'
            ];
        } else {
            return [
                'error'   => true,
                'message' => 'Booking not Existed'
            ];
        }
    }

    public function delete(Request $request)
    {
        $id = $request->customer_id;
        SessionDetails::where('customer_id', $id)
        ->where('qr_id', 0)
        ->delete();
        return redirect()->back()->with('delete', 'Booking Deleted successfully');
    }

    public function orderby_date(Request $request)
    {
        $date = $request->date;
        $records  = Customer::join('session_tickets', 'customers.id', 'session_tickets.customer_id')
        ->join('sessions', 'session_tickets.session_id', 'sessions.id')
        ->where('status', '=', 'manual booked')
        ->where('qr_id', '=', '0')
        ->where('date', $date)
        ->select('customers.name',  'sessions.name as session', 'customers.cnic', 'customers.contact_no', 'customers.id as customers_id', 'session_tickets.id', 'session_tickets.qr_id', 'session_tickets.status', 'session_tickets.date', DB::raw('count(customer_id) as customer_id'))
        ->groupBy('customer_id')
        ->orderBy('id', 'desc')
        ->get();
        return $records;
    }

    public function orderby_session(Request $request)
    {
        $session = $request->session;
        $date = $request->date;
        $records  = Customer::join('session_tickets', 'customers.id', 'session_tickets.customer_id')
        ->join('sessions', 'session_tickets.session_id', 'sessions.id')
        ->where('status', '=', 'manual booked')
        ->where('qr_id', '=', '0')
        ->where('session_id', $session)
        ->where('date', $date)
        ->select('customers.name',  'sessions.name as session', 'customers.cnic', 'customers.contact_no', 'customers.id as customers_id', 'session_tickets.id', 'session_tickets.qr_id', 'session_tickets.status', 'session_tickets.date', DB::raw('count(customer_id) as customer_id'))
        ->groupBy('customer_id')
        ->orderBy('id', 'desc')
        ->get();
        return $records;
    }

    public function booking_pdf()
    {
        // $details = SessionDetails::all();

        include('tcpdf/tcpdf.php');

        // include('tcpdf/config/tcpdf_config.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // $pdf->Cell(190,10,"this is a cell",1,1, 'C');

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('OK');
        $pdf->SetTitle('Booking Records');
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
        $pdf->Cell(190, 5, "Booking Records", 0, 1, 'C');
        $pdf->Ln();
        $pdf->Ln(3);

        $html = "
            <table>
                <tr>
                    <th>Name</th>
                    <th>Contact No.</th>
                    <th>CNIC</th>
                    <th>Total No. of Tickets</th>
                    <th>Session</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>";
                $records  = Customer::join('session_tickets', 'customers.id', 'session_tickets.customer_id')
                ->join('sessions', 'session_tickets.session_id', 'sessions.id')
                ->where('status', '=', 'manual booked')
                ->where('qr_id', '=', '0')
                ->select('customers.name', 'sessions.to', 'sessions.from' , 'sessions.id as session_id', 'sessions.name as session', 'customers.cnic', 'customers.contact_no', 'customers.id as customers_id', 'session_tickets.id', 'session_tickets.qr_id', 'session_tickets.status', 'session_tickets.date', DB::raw('count(customer_id) as customer_id'))
                ->groupBy('customer_id')
                ->orderBy('id', 'desc')
                ->get();
            foreach($records as $item){
        $html .= "
                <tr>
                    <td>". $item->name ."</td>
                    <td>". $item->contact_no ."</td>
                    <td>". $item->cnic ."</td>
                    <td>". $item->customer_id ."</td>
                    <td>". $item->session ."</td>
                    <td>". $item->date ."</td>
                    <td>". $item->status ."</td>
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
                    background-color:#808080;
                    color: #fff;
                    font-weight: bold;
                }
            </style>
        ";

        $pdf->WriteHTMLCell(192, 0, 9, '', $html, 0);

        $pdf->Output('Booking_Records.pdf', 'I');
    }
}
