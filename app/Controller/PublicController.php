<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Exception;

/**
 * PublicController
 * gere le page d'acceuil, la page accés interdit et la page 'à propos'
 */
class PublicController extends Controller
{

    /**
     * index
     *
     * @return void
     */
    public static function index()
    {
        try {
            self::global();
            echo self::getTwig()->render('app/index.html', [
                'global' => self::$global,
            ]);
        } catch (Exception $e) {
            $affiche = new MessageController;
            $affiche->message($e->getMessage());
        }
    }
    public static function forbidden()
    {
        echo self::getTwig()->render('app/403.html');
    }

    /**
     * about
     *genere le fichier PDF de la page html du CV
     * @return void
     */
    public static function about()
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $page = file_get_contents("./doc/cv.html");
        $dompdf->loadHtml($page);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $dompdf->stream("CV_JP", array("Attachment" => 0));
    }
    /**
     * mention
     *
     * @return void
     */
    public static function mentions()
    {
        try {

            self::global();
            echo self::getTwig()->render('article/mentions.html', [
                'global' => self::$global,
            ]);
        } catch (Exception $e) {
            $affiche = new MessageController;
            $affiche->message($e->getMessage());
        }
    }
}
