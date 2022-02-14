<?php 
if ((strpos(strtolower($_SERVER['SCRIPT_NAME']), strtolower(basename(__FILE__)))) !== false) { // NOT FALSE if the script"s file name is found in the URL
    header('HTTP/1.0 403 Forbidden');
    die('<h2>Direct access to this page is not allowed.</h2>');
}

$script = <<< "JS"
    
    function showDashVehicleSum(){var t="vhc_summary_year",a="vhc_summary_month",e=mainTab.cells("dashboard_vehicle_summary").attachLayout({pattern:"2U",cells:[{id:"a",header:!1},{id:"b",header:!1}]}),s=e.cells("a").attachLayout({pattern:"2E",cells:[{id:"a",header:!1},{id:"b",header:!1}]}),l=e.cells("b").attachLayout({pattern:"2E",cells:[{id:"a",header:!1},{id:"b",header:!1}]}),o=mainTab.cells("dashboard_vehicle_summary").attachMenu({icon_path:"./public/codebase/icons/",items:[{id:"month",text:genSelectMonth(t,a)},{id:"refresh",text:"Resize",img:"resize.png"},{id:"vehicle_data",text:"Data Reservasi Kendaraan",img:"app18.png"}]});function r(){let e=$("#"+t).val(),o=$("#"+a).val();s.cells("a").progressOn(),reqJson(DashVehicle("getTotalByColumn",{month_start_date:o,year_start_date:e,equal_status:"CLOSED",column:"total_rev"}),"POST",null,((t,a)=>{"success"===a.status&&(n("vhc_top_left","Total Reservasi "+nameOfMonth(o),"Total Reservasi",a.series,a.color),s.cells("a").progressOff())})),l.cells("a").progressOn(),reqJson(DashVehicle("getTotalByColumn",{month_start_date:o,year_start_date:e,equal_status:"CLOSED",column:"total_hour"}),"POST",null,((t,a)=>{"success"===a.status&&(n("vhc_top_right","Total Jam "+nameOfMonth(o),"Total Jam",a.series,a.color),l.cells("a").progressOff())})),l.cells("b").progressOn(),reqJson(DashVehicle("getTotalByColumn",{month_start_date:o,year_start_date:e,equal_status:"CLOSED",column:"total_km"}),"POST",null,((t,a)=>{"success"===a.status&&"success"===a.status&&(n("vhc_bottom_right","Total Jarak "+nameOfMonth(o),"Total Jarak",a.series,a.color),l.cells("b").progressOff())})),s.cells("b").progressOn();var r=s.cells("b").attachGrid();r.setHeader("No,Nama Kendaraan Dinas,Total Reservasi,Total Jam,Total Kilometer"),r.setColSorting("str,str,str,str,str"),r.setColTypes("rotxt,rotxt,rotxt,rotxt,rotxt"),r.setColAlign("center,left,left,left,left"),r.setInitWidthsP("5,25,20,25,25"),r.enableSmartRendering(!0),r.attachEvent("onXLE",(function(){s.cells("b").progressOff()})),r.attachFooter(",Total,<span id='vhc_dash_sum_total_rev'>0</span>,<span id='vhc_dash_sum_total_hour'>0</span> Jam,<span id='vhc_dash_sum_total_km'>0</span> KM"),r.init(),r.clearAndLoad(GAOther("getVehicleRevGroupGrid",{month_start_date:o,year_start_date:e,equal_status:"CLOSED"}),(function(){sumGridToElement(r,2,"vhc_dash_sum_total_rev",null,"int"),sumGridToElement(r,3,"vhc_dash_sum_total_hour",null,"float"),sumGridToElement(r,4,"vhc_dash_sum_total_km",null,"float")}))}function n(t,a,e,s,l){Highcharts.chart(t,{chart:{plotBackgroundColor:null,plotBorderWidth:null,plotShadow:!1,type:"pie"},title:{text:a},tooltip:{pointFormat:"{series.name}: <b>{point.percentage:.1f}%</b>"},accessibility:{point:{valueSuffix:"%"}},plotOptions:{pie:{colors:l,allowPointSelect:!0,cursor:"pointer",dataLabels:{enabled:!0,format:"<b>{point.name}</b>: {point.percentage:.1f} %"}}},series:[{name:e,colorByPoint:!0,data:s}]})}$("#"+t).on("change",(function(){r()})),$("#"+a).on("change",(function(){r()})),o.attachEvent("onClick",(function(e){switch(e){case"refresh":r();break;case"vehicle_data":var s=$("#"+t).val(),l=$("#"+a).val();mainTab.tabs("dashboard_vehicle_summary_data_tab_"+nameOfMonth(l))?mainTab.tabs("dashboard_vehicle_summary_data_tab_"+nameOfMonth(l)).setActive():(mainTab.addTab("dashboard_vehicle_summary_data_tab_"+nameOfMonth(l),tabsStyle("app18.png","Data Kendaraan Dinas "+nameOfMonth(l)+" "+s,"background-size: 16px 16px"),null,null,!0,!0),showDashVehicleSumData("dashboard_vehicle_summary_data_tab_"+nameOfMonth(l),s,l))}})),s.cells("a").attachHTMLString("<div class='hc_graph' style='width:100%;height:100%' id='vhc_top_left'></div>"),s.cells("b").attachHTMLString("<div class='hc_graph' style='width:100%;height:100%' id='vhc_bottom_left'></div>"),l.cells("a").attachHTMLString("<div class='hc_graph' style='width:100%;height:100%' id='vhc_top_right'></div>"),l.cells("b").attachHTMLString("<div class='hc_graph' style='width:100%;height:100%' id='vhc_bottom_right'></div>"),r()}

JS;
header('Content-Type: application/javascript');
echo $script;