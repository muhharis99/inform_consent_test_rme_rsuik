<?php
require_once (dirname(__FILE__) . '/graph/src/jpgraph.php'); 
require_once (dirname(__FILE__) . '/graph/src/jpgraph_line.php'); 
require_once (dirname(__FILE__) . '/graph/src/jpgraph_bar.php'); 


// Create the graph.
$graph = new Graph($width, $height);
$graph->clearTheme();
$graph->SetScale("textlin");
$graph->SetMargin(40,20,40,60);
$graph->xaxis->SetTickLabels($arr_bulan);

// Create the linear error plot
$l1plot=new LinePlot($line);
$l1plot->SetColor("red");
$l1plot->SetWeight(3);
$l1plot->SetLegend($line_legend);

//Center the line plot in the center of the bars
$l1plot->SetBarCenter();


// Create the bar plot
$bplot = new BarPlot($bar);
$bplot->SetFillColor("orange");
$bplot->SetLegend($bar_legend);

// Add the plots to t'he graph
$graph->Add($bplot);
$graph->Add($l1plot);
$graph->legend->SetPos(0.5,0.98,'center','bottom');
$graph->legend->SetLayout(LEGEND_HOR);


$graph->title->Set($title);
$graph->xaxis->title->Set($x_title);
$graph->yaxis->title->Set($y_title);

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);


// Display the graph
$graph->Stroke();
?>