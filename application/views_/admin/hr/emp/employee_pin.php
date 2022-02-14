<?php 
if ((strpos(strtolower($_SERVER['SCRIPT_NAME']), strtolower(basename(__FILE__)))) !== false) { // NOT FALSE if the script"s file name is found in the URL
    header('HTTP/1.0 403 Forbidden');
    die('<h2>Direct access to this page is not allowed.</h2>');
}

$script = <<< "JS"

	function showEmpPin(){var e,t,a=mainTab.cells("hr_data_pin_karyawan").attachLayout({pattern:"2U",cells:[{id:"a",header:!1},{id:"b",text:"Form PIN Karyawan",header:!0,collapse:!0}]}),l=mainTab.cells("hr_data_pin_karyawan").attachToolbar({icon_path:"./public/codebase/icons/",items:[{id:"refresh",text:"Refresh",type:"button",img:"refresh.png"},{id:"add",text:"Tambah",type:"button",img:"add.png"},{id:"delete",text:"Hapus",type:"button",img:"delete.png"},{id:"edit",text:"Ubah",type:"button",img:"edit.png",img_disabled:"edit_disabled.png"},{id:"searchtext",text:"Cari : ",type:"text"},{id:"search",text:"",type:"buttonInput",width:150}]});"admin"!==userLogged.role&&(l.disableItem("add"),l.disableItem("delete"));var n=a.cells("a").attachStatusBar();function r(){let e=s.getRowsNum();n.setText("Total baris: "+e)}var s=a.cells("a").attachGrid();function i(){a.cells("a").progressOn(),s.clearAndLoad(Emp("pinGrid",{search:l.getValue("search")}),r)}s.setHeader("No,Nama Karyawan,NIP,PIN,Jabatan,Sub Unit,Bagian,Sub Bagian,Created By,Updated By,DiBuat"),s.attachHeader("#rspan,#text_filter,#text_filter,#text_filter,#select_filter,#select_filter,#select_filter,#select_filter,#text_filter,#text_filter,#text_filter"),s.setColSorting("str,str,str,str,str,str,str,str,str,str,str"),s.setColTypes("rotxt,rotxt,rotxt,rotxt,rotxt,rotxt,rotxt,rotxt,rotxt,rotxt,rotxt,rotxt"),s.setColAlign("center,left,left,left,left,left,left,left,left,left,left"),s.setInitWidthsP("5,20,15,20,20,20,20,20,20,20,25"),s.enableSmartRendering(!0),s.enableMultiselect(!0),s.attachEvent("onXLE",(function(){a.cells("a").progressOff()})),s.init(),i(),l.attachEvent("onClick",(function(n){switch(n){case"refresh":l.setValue("search",""),i();break;case"add":!function(){a.cells("b").expand(),a.cells("b").showView("tambah_pin"),e=a.cells("b").attachForm([{type:"fieldset",offsetTop:30,offsetLeft:30,label:"Tambah Jenis Training",list:[{type:"combo",name:"nip",label:"Nama Karyawan",labelWidth:130,inputWidth:250,validate:"NotEmpty",required:!0},{type:"input",name:"pin",label:"PIN",labelWidth:130,inputWidth:250,required:!0,validate:"ValidNumeric"},{type:"block",offsetTop:30,list:[{type:"button",name:"add",className:"button_add",offsetLeft:15,value:"Tambah"},{type:"newcolumn"},{type:"button",name:"clear",className:"button_clear",offsetLeft:30,value:"Clear"},{type:"newcolumn"},{type:"button",name:"cancel",className:"button_no",offsetLeft:30,value:"Cancel"}]}]}]),isFormNumeric(e,["pin"]);var t=e.getCombo("nip");function l(e){t.clearAll(),e.length>3&&dhx.ajax.get(User("getEmps",{name:e}),(function(e){e.xmlDoc.responseText&&(t.load(e.xmlDoc.responseText),t.openSelect())}))}t.enableFilteringMode(!0,"nip"),t.attachEvent("onDynXLS",l),e.attachEvent("onButtonClick",(function(t){switch(t){case"add":if(!e.validate())return eAlert("Input error!");if(e.getItemValue("pin").length>6)return eAlert("Maksimum 6 digit!");setDisable(["add","clear"],e,a.cells("b"));let t=new dataProcessor(Emp("pinForm"));t.init(e),e.save(),t.attachEvent("onAfterUpdate",(function(t,l,n,r){let s=r.getAttribute("message");switch(l){case"inserted":sAlert("Berhasil Menambahkan Record <br>"+s),i(),clearAllForm(e),clearComboNoReload(e,"nip"),setEnable(["add","clear"],e,a.cells("b"));break;case"error":eAlert("Gagal Menambahkan Record <br>"+s),setEnable(["add","clear"],e,a.cells("b"))}}));break;case"clear":clearAllForm(e);break;case"cancel":a.cells("b").collapse()}}))}();break;case"delete":reqAction(s,Emp("pinDelete"),1,((e,t)=>{i(),t.mSuccess&&sAlert("Sukses Menghapus Record <br>"+t.mSuccess),t.mError&&eAlert("Gagal Menghapus Record <br>"+t.mError)}));break;case"edit":!function(){if(!s.getSelectedRowId())return eAlert("Pilih baris yang akan diubah!");a.cells("b").expand(),a.cells("b").showView("edit_pin"),t=a.cells("b").attachForm([{type:"fieldset",offsetTop:30,offsetLeft:30,label:"Ubah Jenis Training",list:[{type:"hidden",name:"id",label:"ID",readonly:!0},{type:"input",name:"employee_name",label:"Nama Karyawan",labelWidth:130,inputWidth:250,required:!0},{type:"input",name:"pin",label:"PIN",labelWidth:130,inputWidth:250,required:!0,validate:"ValidNumeric"},{type:"block",offsetTop:30,list:[{type:"button",name:"update",className:"button_update",offsetLeft:15,value:"Simpan"},{type:"newcolumn"},{type:"button",name:"cancel",className:"button_no",offsetLeft:30,value:"Cancel"}]}]}]),fetchFormData(Emp("pinForm",{id:s.getSelectedRowId()}),t),t.attachEvent("onButtonClick",(function(e){switch(e){case"update":if(!t.validate())return eAlert("Input error!");setDisable(["update","cancel"],t,a.cells("b"));let e=new dataProcessor(Emp("pinForm"));e.init(t),t.save(),e.attachEvent("onAfterUpdate",(function(e,l,n,r){let s=r.getAttribute("message");switch(l){case"updated":sAlert("Berhasil Mengubah Record <br>"+s),i(),a.cells("b").progressOff(),a.cells("b").showView("tambah_pin"),a.cells("b").collapse();break;case"error":eAlert("Gagal Mengubah Record <br>"+s),setEnable(["update","cancel"],t,a.cells("b"))}}));break;case"cancel":i(),a.cells("b").collapse(),a.cells("b").showView("tambah_pin")}}))}()}})),l.attachEvent("onEnter",(function(e){switch(e){case"search":i(),s.attachEvent("onGridReconstructed",r)}}))}

JS;

header('Content-Type: application/javascript');
echo $script;
    