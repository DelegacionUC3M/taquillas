<?php

class PDF extends FPDF
{
    var $HREF;
    var $B;
    var $I;
    var $U;

    //Cabecera de página
    function Header ()
    {
        $this->Image(ABSPATH.'assets/img/biglogo.jpg',10,8,40);
        $this->Image(ABSPATH.'assets/img/logodele.jpg',180,9,16);
        $this->SetTextColor(16,13,98);
        $this->SetFont('Times','',8);
        //$this->Cell(75);
        //Cell(float w , float h , string txt , mixed border , int ln , string align , boolean fill , mixed link)
        $this->Cell(0,4,utf8_decode('DELEGACIÓN DE ESTUDIANTES'),0,2,'C');
        $this->Cell(0,4,utf8_decode('RESGUARDO DE PAGO DE TAQUILLA'),0,2,'C');
        //Salto de línea
        $this->Ln(20);
    }

    function WriteHTML ($html)
    {
        //Intérprete de HTML
        $html = str_replace("\n", ' ', $html);
        $a = preg_split('/<(.*)>/U', $html, - 1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($a as $i => $e) {
            if ($i % 2 == 0) {
                //Text
                if ($this->HREF)
                    $this->PutLink($this->HREF, $e);
                else
                    $this->Write(5, $e);
            } else {
                //Etiqueta
                if ($e[0] == '/')
                    $this->CloseTag(strtoupper(substr($e, 1)));
                else {
                    //Extraer atributos
                    $a2 = explode(' ', $e);
                    $tag = strtoupper(array_shift($a2));
                    $attr = array();
                    foreach ($a2 as $v) {
                        if (preg_match('/([^=]*)=["\']?([^"\']*)/', $v, $a3))
                            $attr[strtoupper($a3[1])] = $a3[2];
                    }
                    $this->OpenTag($tag, $attr);
                }
            }
        }
    }

    function OpenTag ($tag, $attr)
    {
        //Etiqueta de apertura
        if ($tag == 'B' || $tag == 'I' || $tag == 'U')
            $this->SetStyle($tag, true);
        if ($tag == 'A')
            $this->HREF = $attr['HREF'];
        if ($tag == 'BR')
            $this->Ln(5);
    }

    function CloseTag ($tag)
    {
        //Etiqueta de cierre
        if ($tag == 'B' || $tag == 'I' || $tag == 'U')
            $this->SetStyle($tag, false);
        if ($tag == 'A')
            $this->HREF = '';
    }

    function SetStyle ($tag, $enable)
    {
        //Modificar estilo y escoger la fuente correspondiente
        $this->$tag += ($enable ? 1 : - 1);
        $style = '';
        foreach (array('B', 'I', 'U') as $s) {
            if ($this->$s > 0)
                $style .= $s;
        }
        $this->SetFont('', $style);
    }

    function PutLink ($URL, $txt)
    {
        //Escribir un hiper-enlace
        $this->SetTextColor(0, 0, 255);
        $this->SetStyle('U', true);
        $this->Write(5, $txt, $URL);
        $this->SetStyle('U', false);
        $this->SetTextColor(0);
    }
}