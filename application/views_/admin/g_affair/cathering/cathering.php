<?php 
if ((strpos(strtolower($_SERVER['SCRIPT_NAME']), strtolower(basename(__FILE__)))) !== false) { // NOT FALSE if the script"s file name is found in the URL
    header('HTTP/1.0 403 Forbidden');
    die('<h2>Direct access to this page is not allowed.</h2>');
}

$script = <<< "JS"

	function showCathering(){var e,t,a=mainTab.cells("ga_cathering_vendor").attachLayout({pattern:"2U",cells:[{id:"a",header:!1},{id:"b",text:"Form Katering",header:!0,collapse:!0}]}),r=mainTab.cells("ga_cathering_vendor").attachToolbar({icon_path:"./public/codebase/icons/",items:[{id:"refresh",text:"Refresh",type:"button",img:"refresh.png"},{id:"add",text:"Tambah",type:"button",img:"add.png"},{id:"delete",text:"Hapus",type:"button",img:"delete.png"},{id:"edit",text:"Ubah",type:"button",img:"edit.png",img_disabled:"edit_disabled.png"},{id:"active",text:"Aktifkan",type:"button",img:"check.png"},{id:"searchtext",text:"Cari : ",type:"text"},{id:"search",text:"",type:"buttonInput",width:150}]});"admin"!==userLogged.role&&(r.disableItem("add"),r.disableItem("delete"));var l=a.cells("a").attachStatusBar();function n(){let e=i.getRowsNum();l.setText("Total baris: "+e)}var i=a.cells("a").attachGrid();function s(){a.cells("a").progressOn(),i.clearAndLoad(GAOther("catheringPriceGrid",{search:r.getValue("search")}),n)}i.setHeader("No,Nama Vendor,Harga,Status,Masa Berakhir Kontrak,Created By,Updated By,DiBuat"),i.attachHeader("#rspan,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter,#text_filter"),i.setColSorting("str,str,str,str,str,str,str,str"),i.setColTypes("rotxt,rotxt,ron,rotxt,rotxt,rotxt,rotxt,rotxt"),i.setColAlign("center,left,left,left,left,left,left,left"),i.setInitWidthsP("5,25,15,15,20,15,15,25"),i.enableSmartRendering(!0),i.enableMultiselect(!0),i.attachEvent("onXLE",(function(){a.cells("a").progressOff()})),i.setNumberFormat("0,000",2,".",","),i.init(),s(),r.attachEvent("onClick",(function(l){switch(l){case"refresh":r.setValue("search",""),s();break;case"add":a.cells("b").expand(),a.cells("b").showView("tambah_cathering"),e=a.cells("b").attachForm([{type:"fieldset",offsetTop:30,offsetLeft:30,label:"Tambah Jenis Training",list:[{type:"input",name:"vendor_name",label:"Nama Vendor",labelWidth:130,inputWidth:250,required:!0},{type:"input",name:"price",label:"Harga",labelWidth:130,inputWidth:250,required:!0,validate:"ValidNumeric"},{type:"calendar",name:"expired",label:"Masa Berakhir Kontrak",labelWidth:130,inputWidth:250,required:!0},{type:"block",offsetTop:30,list:[{type:"button",name:"add",className:"button_add",offsetLeft:15,value:"Tambah"},{type:"newcolumn"},{type:"button",name:"clear",className:"button_clear",offsetLeft:30,value:"Clear"},{type:"newcolumn"},{type:"button",name:"cancel",className:"button_no",offsetLeft:30,value:"Cancel"}]}]}]),isFormNumeric(e,["price"]),e.attachEvent("onButtonClick",(function(t){switch(t){case"add":if(!e.validate())return eAlert("Input error!");setDisable(["add","clear"],e,a.cells("b"));let t=new dataProcessor(GAOther("catheringForm"));t.init(e),e.save(),t.attachEvent("onAfterUpdate",(function(t,r,l,n){let i=n.getAttribute("message");switch(r){case"inserted":sAlert("Berhasil Menambahkan Record <br>"+i),s(),clearAllForm(e),setEnable(["add","clear"],e,a.cells("b"));break;case"error":eAlert("Gagal Menambahkan Record <br>"+i),setEnable(["add","clear"],e,a.cells("b"))}}));break;case"clear":clearAllForm(e);break;case"cancel":a.cells("b").collapse()}}));break;case"delete":reqAction(i,GAOther("catheringDelete"),1,((e,t)=>{s(),t.mSuccess&&sAlert("Sukses Menghapus Record <br>"+t.mSuccess),t.mError&&eAlert("Gagal Menghapus Record <br>"+t.mError)}));break;case"edit":!function(){if(!i.getSelectedRowId())return eAlert("Pilih baris yang akan diubah!");a.cells("b").expand(),a.cells("b").showView("edit_cathering"),t=a.cells("b").attachForm([{type:"fieldset",offsetTop:30,offsetLeft:30,label:"Ubah Jenis Training",list:[{type:"hidden",name:"id",label:"ID",readonly:!0},{type:"input",name:"vendor_name",label:"Nama Vendor",labelWidth:130,inputWidth:250,required:!0},{type:"input",name:"price",label:"Harga",labelWidth:130,inputWidth:250,required:!0,validate:"ValidNumeric"},{type:"calendar",name:"expired",label:"Masa Berakhir Kontrak",labelWidth:130,inputWidth:250,required:!0},{type:"block",offsetTop:30,list:[{type:"button",name:"update",className:"button_update",offsetLeft:15,value:"Simpan"},{type:"newcolumn"},{type:"button",name:"cancel",className:"button_no",offsetLeft:30,value:"Cancel"}]}]}]),isFormNumeric(t,["price"]),fetchFormData(GAOther("catheringForm",{id:i.getSelectedRowId()}),t),t.attachEvent("onButtonClick",(function(e){switch(e){case"update":if(!t.validate())return eAlert("Input error!");setDisable(["update","cancel"],t,a.cells("b"));let e=new dataProcessor(GAOther("catheringForm"));e.init(t),t.save(),e.attachEvent("onAfterUpdate",(function(e,r,l,n){let i=n.getAttribute("message");switch(r){case"updated":sAlert("Berhasil Mengubah Record <br>"+i),s(),a.cells("b").progressOff(),a.cells("b").showView("tambah_cathering"),a.cells("b").collapse();break;case"error":eAlert("Gagal Mengubah Record <br>"+i),setEnable(["update","cancel"],t,a.cells("b"))}}));break;case"cancel":s(),a.cells("b").collapse(),a.cells("b").showView("tambah_cathering")}}))}();break;case"active":!function(){if(!i.getSelectedRowId())return eAlert("Pilih vendor yang akan diakrifkan!");let e=i.cells(i.getSelectedRowId(),1).getValue();dhtmlx.modalbox({type:"alert-warning",title:"Konfirmasi Aktifasi Vendor",text:"Anda yakin akan mengaktifkan vendor "+e+"?",buttons:["Ya","Tidak"],callback:function(e){0==e&&reqJson(GAOther("setCathActive"),"POST",{id:i.getSelectedRowId()},((e,t)=>{"success"===t.status?(s(),sAlert(t.message)):eAlert(t.message)}))}})}()}})),r.attachEvent("onEnter",(function(e){switch(e){case"search":s(),i.attachEvent("onGridReconstructed",n)}}))}

JS;

header('Content-Type: application/javascript');
echo $script;
