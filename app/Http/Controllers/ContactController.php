<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class ContactController extends Controller

{

    /**

     * Write code on Method

     *

     * @return response()

     */

    public function index()

    {

        return view('home');
    }



    /**

     * Write code on Method

     *

     * @return response()

     */

    public function store(Request $request)

    {



        // Send the email

        try {
            $request->validate([

                'name' => 'required',

                'email' => 'required|email',

                'subject' => 'required',

                'message' => 'required'

            ]);

            $mail = new PHPMailer(true);
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->isSMTP();
            $mail->Host       = 'mail.segarahutamagroup.co.id';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'contact@segarahutamagroup.co.id';
            $mail->Password   = 'segarahutamagroup.co.id';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom('contact@segarahutamagroup.co.id', 'BENKKSTUDIOS');
            $mail->addAddress('abenkdh@gmail.com', 'Segara Hutama Group');

            // Sending plain text email
            $mail->isHTML(false); // Set email format to plain text
            $mail->Subject = 'Your Subject Here';
            $mail->Body    = 'This is the plain text message body';
            return view('emails.contact')->with('data', $mail->send());
        } catch (Exception $e) {
            return view('emails.contact')->with('data', $e);
        }
        //Server settings

    }
}
