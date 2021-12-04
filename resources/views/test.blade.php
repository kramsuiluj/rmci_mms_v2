<?php
require_once 'C:\Mark\laravel\rmci_mms_v2\vendor\autoload.php';
//
//// Creating the new document...
//$phpWord = new \PhpOffice\PhpWord\PhpWord();
//
///* Note: any element you append to a document must reside inside of a Section. */
//
//// Adding an empty Section to the document...
//$section = $phpWord->addSection();
//// Adding Text element to the Section having font styled by default...
//$section->addText(
//    '"Learn from yesterday, live for today, hope for tomorrow. '
//    . 'The important thing is not to stop questioning." '
//    . '(Albert Einstein)'
//);
//
///*
// * Note: it's possible to customize font style of the Text element you add in three ways:
// * - inline;
// * - using named font style (new font style object will be implicitly created);
// * - using explicitly created font style object.
// */
//
//// Adding Text element with font customized inline...
//$section->addText(
//    '"Great achievement is usually born of great sacrifice, '
//    . 'and is never the result of selfishness." '
//    . '(Napoleon Hill)',
//    array('name' => 'Tahoma', 'size' => 10)
//);
//
//// Adding Text element with font customized using named font style...
//$fontStyleName = 'oneUserDefinedStyle';
//$phpWord->addFontStyle(
//    $fontStyleName,
//    array('name' => 'Tahoma', 'size' => 10, 'color' => '1B2232', 'bold' => true)
//);
//$section->addText(
//    '"The greatest accomplishment is not in never falling, '
//    . 'but in rising again after you fall." '
//    . '(Vince Lombardi)',
//    $fontStyleName
//);
//
//// Adding Text element with font customized using explicitly created font style object...
//$fontStyle = new \PhpOffice\PhpWord\Style\Font();
//$fontStyle->setBold(true);
//$fontStyle->setName('Tahoma');
//$fontStyle->setSize(13);
//$myTextElement = $section->addText('"Believe you can and you\'re halfway there." (Theodor Roosevelt)');
//$myTextElement->setFontStyle($fontStyle);
//
//// Saving the document as OOXML file...
//$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
//$objWriter->save('helloWorld.docx');
//
//// Saving the document as ODF file...
//$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'ODText');
//$objWriter->save('helloWorld.odt');
//
//// Saving the document as HTML file...
//$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
//$objWriter->save('helloWorld.html');
//
///* Note: we skip RTF, because it's not XML-based and requires a different example. */
///* Note: we skip PDF, because "HTML-to-PDF" approach is used to create PDF documents. */

//phpinfo();


//if (!extension_loaded('imagick')){
//    echo 'imagick not installed';
//}

//$imgExt = new Imagick();
//$imgExt->readImage(public_path('pdf-document.pdf'));
//$imgExt->writeImages('pdf_image_doc.jpg', true);
//
//dd("Document has been converted");


//$phpWord = new \PhpOffice\PhpWord\PhpWord();
////Searching for values to replace
//$document = $phpWord->loadTemplate('C:\Users\Mark\Documents/test2.docx');
//$document->setValue('name', 'Mark');
//// // save as a random file in temp file
//$temp_file = tempnam(sys_get_temp_dir(), 'PHPWord');
//$document->saveAs($temp_file);
//
//// Your browser will name the file "myFile.docx"
//// regardless of what it's named on the server
//header("Content-Disposition: attachment; filename='test2.docx'");
//readfile($temp_file); // or echo file_get_contents($temp_file);
//unlink($temp_file);  // remove temp file




//$templaceProcessor = new \PhpOffice\PhpWord\TemplateProcessor('Template.docx');










phpinfo();





//error_reporting(E_ALL);
//ini_set( 'display_errors','1');
//
///* Create a new imagick object */
//$im = new Imagick();
//
///* Create new image. This will be used as fill pattern */
//$im->newPseudoImage(50, 50, "gradient:red-black");
//
///* Create imagickdraw object */
//$draw = new ImagickDraw();
//
///* Start a new pattern called "gradient" */
//$draw->pushPattern('gradient', 0, 0, 50, 50);
//
///* Composite the gradient on the pattern */
//$draw->composite(Imagick::COMPOSITE_OVER, 0, 0, 50, 50, $im);
//
///* Close the pattern */
//$draw->popPattern();
//
///* Use the pattern called "gradient" as the fill */
//$draw->setFillPatternURL('#gradient');
//
///* Set font size to 52 */
//$draw->setFontSize(52);
//
///* Annotate some text */
//$draw->annotation(20, 50, "Hello World!");
//
///* Create a new canvas object and a white image */
//$canvas = new Imagick();
//$canvas->newImage(350, 70, "white");
//
///* Draw the ImagickDraw on to the canvas */
//$canvas->drawImage($draw);
//
///* 1px black border around the image */
//$canvas->borderImage('black', 1, 1);
//
///* Set the format to PNG */
//$canvas->setImageFormat('png');
//
///* Output the image */
//header("Content-Type: image/png");
//echo $canvas;
