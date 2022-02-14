<?php 
if ((strpos(strtolower($_SERVER['SCRIPT_NAME']), strtolower(basename(__FILE__)))) !== false) { // NOT FALSE if the script"s file name is found in the URL
    header('HTTP/1.0 403 Forbidden');
    die('<h2>Direct access to this page is not allowed.</h2>');
}

$script = <<< "JS"
	
    function showMasterLocation(){var e,t,a=mainTab.cells("master_location").attachLayout({pattern:"2U",cells:[{id:"a",header:!1},{id:"b",text:"Form Lokasi",header:!0,collapse:!0}]}),l=mainTab.cells("master_location").attachToolbar({icon_path:"./public/codebase/icons/",items:[{id:"refresh",text:"Refresh",type:"button",img:"refresh.png"},{id:"add",text:"Tambah",type:"button",img:"add.png"},{id:"delete",text:"Hapus",type:"button",img:"delete.png"},{id:"edit",text:"Ubah",type:"button",img:"edit.png",img_disabled:"edit_disabled.png"},{id:"searchtext",text:"Cari : ",type:"text"},{id:"search",text:"",type:"buttonInput",width:150}]});"admin"!==userLogged.role&&(l.disableItem("add"),l.disableItem("delete"));var s=a.cells("a").attachStatusBar();function r(){let e=c.getRowsNum();s.setText("Total baris: "+e)}var c=a.cells("a").attachGrid();function o(){a.cells("a").progressOn(),c.clearAndLoad(AppMaster("locGrid",{search:l.getValue("search")}),r)}c.setHeader("No,Kode,Lokasi,Created By,Updated By,DiBuat"),c.attachHeader("#rspan,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter"),c.setColSorting("str,str,str,str,str,str"),c.setColTypes("rotxt,rotxt,rotxt,rotxt,rotxt,rotxt"),c.setColAlign("center,left,left,left,left,left"),c.setInitWidthsP("5,20,20,15,15,25"),c.enableSmartRendering(!0),c.enableMultiselect(!0),c.attachEvent("onXLE",(function(){a.cells("a").progressOff()})),c.init(),o(),l.attachEvent("onClick",(function(s){switch(s){case"refresh":l.setValue("search",""),o();break;case"add":a.cells("b").expand(),a.cells("b").showView("tambah_location"),(e=a.cells("b").attachForm([{type:"fieldset",offsetTop:30,offsetLeft:30,label:"Tambah Lokasi",list:[{type:"input",name:"code",label:"Kode Lokasi",labelWidth:130,inputWidth:250,required:!0},{type:"input",name:"name",label:"Nama Lokasi",labelWidth:130,inputWidth:250,required:!0},{type:"block",offsetTop:30,list:[{type:"button",name:"add",className:"button_add",offsetLeft:15,value:"Tambah"},{type:"newcolumn"},{type:"button",name:"clear",className:"button_clear",offsetLeft:30,value:"Clear"},{type:"newcolumn"},{type:"button",name:"cancel",className:"button_no",offsetLeft:30,value:"Cancel"}]}]}])).attachEvent("onButtonClick",(function(t){switch(t){case"add":if(!e.validate())return eAlert("Input error!");setDisable(["add","clear"],e,a.cells("b"));let t=new dataProcessor(AppMaster("locForm"));t.init(e),e.save(),t.attachEvent("onAfterUpdate",(function(t,l,s,r){let c=r.getAttribute("message");switch(l){case"inserted":sAlert("Berhasil Menambahkan Record <br>"+c),o(),clearAllForm(e),setEnable(["add","clear"],e,a.cells("b"));break;case"error":eAlert("Gagal Menambahkan Record <br>"+c),setEnable(["add","clear"],e,a.cells("b"))}}));break;case"clear":clearAllForm(e);break;case"cancel":o(),a.cells("b").collapse()}}));break;case"delete":reqAction(c,AppMaster("locDelete"),1,((e,t)=>{o(),t.mSuccess&&sAlert("Sukses Menghapus Record <br>"+t.mSuccess),t.mError&&eAlert("Gagal Menghapus Record <br>"+t.mError)}));break;case"edit":!function(){if(!c.getSelectedRowId())return eAlert("Pilih baris yang akan diubah!");a.cells("b").expand(),a.cells("b").showView("edit_loc"),t=a.cells("b").attachForm([{type:"fieldset",offsetTop:30,offsetLeft:30,label:"Ubah Lokasi",list:[{type:"hidden",name:"id",label:"ID",readonly:!0},{type:"input",name:"code",label:"Kode Lokasi",labelWidth:130,inputWidth:250,required:!0,readonly:!0},{type:"input",name:"name",label:"Nama Lokasi",labelWidth:130,inputWidth:250,required:!0},{type:"block",offsetTop:30,list:[{type:"button",name:"update",className:"button_update",offsetLeft:15,value:"Simpan"},{type:"newcolumn"},{type:"button",name:"cancel",className:"button_no",offsetLeft:30,value:"Cancel"}]}]}]),fetchFormData(AppMaster("locForm",{id:c.getSelectedRowId()}),t),t.attachEvent("onButtonClick",(function(e){switch(e){case"update":if(!t.validate())return eAlert("Input error!");setDisable(["update","cancel"],t,a.cells("b"));let e=new dataProcessor(AppMaster("locForm"));e.init(t),t.save(),e.attachEvent("onAfterUpdate",(function(e,l,s,r){let c=r.getAttribute("message");switch(l){case"updated":sAlert("Berhasil Mengubah Record <br>"+c),o(),a.cells("b").progressOff(),a.cells("b").showView("tambah_location"),a.cells("b").collapse();break;case"error":eAlert("Gagal Mengubah Record<br>"+c),setEnable(["update","cancel"],t,a.cells("b"))}}));break;case"cancel":a.cells("b").collapse(),a.cells("b").showView("tambah_location")}}))}()}})),l.attachEvent("onEnter",(function(e){switch(e){case"search":o(),c.attachEvent("onGridReconstructed",r)}}))}
	
JS;

header('Content-Type: application/javascript');
echo $script;
