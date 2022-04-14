<?php

namespace App\Http\Controllers;

use App\Models\create_users;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use PDF;
use Barryvdh\DomPDF\Facade;
use Facade\FlareClient\View;

class PDFController extends Controller
{
    public function createPDF() {
        // retreive all records from db
        $data = create_users::all();

        // share data to view
        view()->share('info',$data);
        $pdf = PDF::loadView('admin.add users.pdf.user', $data);

        // download PDF file with download method
        return $pdf->stream('pdf_file.pdf');
      }
  }


