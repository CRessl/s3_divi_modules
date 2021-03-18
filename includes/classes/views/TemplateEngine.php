<?php
class TemplateEngine
{
    /**
     * Der Ordner in dem sich die Templates befinden.
     */
    private $templateDir = "templates/";

    /**
     * Der linke Delimter für einen Standard-Platzhalter.
     */
    private $leftDelimeter = '{$';

    /**
     * Der rechte Delimter für einen Standard-Platzhalter.
     */
    private $rightDelimeter = '}';

    /**
     * Der linke Delimter für eine Funktion.
     */
    private $leftDelimeterF = '{';

    /**
     * Der rechte Delimter für eine Funktion.
     */
    private $rightDelimeterF = '}';

    /**
     * Der linke Delimter für ein Kommentar.
     * Sonderzeichen müssen escapt werden, weil der Delimter in einem regulärem
     * Ausdruck verwendet wird.
     */
    private $leftDelimeterC = '\{\*';

    /**
     * Der rechte Delimter für ein Kommentar.
     * Sonderzeichen müssen escapt werden, weil der Delimter in einem regulärem
     * Ausdruck verwendet wird.
     */
    private $rightDelimeterC = '\*\}';

    /**
     * Der komplette Pfad der Templatedatei.
     */
    private $templateFile = "";

    /**
     * Der Dateiname der Templatedatei.
     */
    private $templateName = "";

    /**
     * Der Inhalt des Templates.
     */
    private $template = "";


    /**
     * Die Pfade festlegen.
     * In unserem Falle den Template Pfad. Die Sprache kommt optimalerweise aus der Datenbank
     */
    public function __construct($tpl_dir = "") {
        // Template Ordner
        if ( !empty($tpl_dir) ) {
            $this->templateDir = $tpl_dir;
        }

    }

    /**
     * Eine Templatedatei öffnen.
     *
     * @access    public
     * @param     string $file Dateiname des Templates.
     * @uses      $templateName
     * @uses      $templateFile
     * @uses      $templateDir
     * @uses      parseFunctions()
     * @return    boolean
     */
    public function load($file){

        $this->templateName = $file;
        $this->templateFile = $this->templateDir.$file;

        // Wenn ein Dateiname übergeben wurde, versuchen, die Datei zu öffnen
        if(!empty($this->templateFile)){
            if(file_exists($this->templateFile)){
                $this->template = file_get_contents($this->templateFile);
            }

        }

    }

    /**
         * Das "fertige Template" ausgeben.
         *
         * @access    public
         * @uses      $template
         */
    public function display() {
        echo $this->template;
    }
}
