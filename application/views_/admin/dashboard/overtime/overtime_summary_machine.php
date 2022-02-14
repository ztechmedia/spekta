<?php 
if ((strpos(strtolower($_SERVER['SCRIPT_NAME']), strtolower(basename(__FILE__)))) !== false) { // NOT FALSE if the script"s file name is found in the URL
    header('HTTP/1.0 403 Forbidden');
    die('<h2>Direct access to this page is not allowed.</h2>');
}

$script = <<< "JS"
    
    function showDashOvertimeMachine(){var e=mainTab.cells("dashboard_overtime_machine_tab").attachLayout({pattern:"2E",cells:[{id:"a",header:!1},{id:"b",header:!1}]}),t=mainTab.cells("dashboard_overtime_machine_tab").attachMenu({icon_path:"./public/codebase/icons/",items:[{id:"month",text:genSelectMonth("dash_year_summary_machine","dash_month_summary_machine")},{id:"refresh",text:"Resize",img:"resize.png"},{id:"export",text:"Export To Excel",img:"excel.png"}]});function a(){sumGridToElement(subOvtMachineHourGrid,4,"total_dash_machine_hour_sub",null,"float")}function r(){let t=$("#dash_year_summary_machine").val(),r=$("#dash_month_summary_machine").val();e.cells("a").progressOn(),e.cells("b").progressOn(),reqJson(Dashboard("getSummaryMachine",{month_overtime_date:r,year_overtime_date:t,equal_status:"CLOSED"}),"POST",{year:t,month:r},((t,i)=>{i.grid.length>0?subOvtMachineHourGrid.parse(i.grid,a,"json"):e.cells("b").progressOff(),e.cells("a").progressOff(),Highcharts.chart("monthly_summary_machine",{chart:{plotBackgroundColor:null,plotBorderWidth:null,plotShadow:!1,type:"pie"},title:{text:"Waktu Penggunaan Mesin "+nameOfMonth(r)+" (Top 10)"},tooltip:{pointFormat:"{series.name}: <b>{point.percentage:.1f}%</b>"},accessibility:{point:{valueSuffix:"%"}},plotOptions:{pie:{allowPointSelect:!0,cursor:"pointer",dataLabels:{enabled:!0,format:"<b>{point.name}</b>: {point.percentage:.1f} %"}}},series:[{name:"Persentase Jam",colorByPoint:!0,data:i.series}]})}))}$("#dash_year_summary_machine").on("change",(function(){r()})),$("#dash_month_summary_machine").on("change",(function(){r()})),t.attachEvent("onClick",(function(e){switch(e){case"refresh":r();break;case"export":subOvtMachineHourGrid.toExcel("./public/codebase/grid-to-excel-php/generate.php"),sAlert("Export Data Dimulai")}})),e.cells("a").attachHTMLString("<div class='hc_graph' id='monthly_summary_machine' style='height:100%;width:100%;'></div>"),subOvtMachineHourGrid=e.cells("b").attachGrid(),subOvtMachineHourGrid.setHeader("No,Nama Mesin,Bagian,Sub Bagian,Jam Operasional"),subOvtMachineHourGrid.setColSorting("str,str,str,str,str"),subOvtMachineHourGrid.setColTypes("rotxt,rotxt,rotxt,rotxt,rotxt"),subOvtMachineHourGrid.setColAlign("center,left,left,left,left"),subOvtMachineHourGrid.setInitWidthsP("10,30,25,25,10"),subOvtMachineHourGrid.enableSmartRendering(!0),subOvtMachineHourGrid.attachEvent("onXLE",(function(){e.cells("b").progressOff()})),subOvtMachineHourGrid.attachFooter(",Total Jam Operasional,<span id='total_dash_machine_hour_sub'>0</span> Jam"),subOvtMachineHourGrid.init(),r()}

JS;
header('Content-Type: application/javascript');
echo $script;