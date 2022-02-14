<?php 
if ((strpos(strtolower($_SERVER['SCRIPT_NAME']), strtolower(basename(__FILE__)))) !== false) { // NOT FALSE if the script"s file name is found in the URL
    header('HTTP/1.0 403 Forbidden');
    die('<h2>Direct access to this page is not allowed.</h2>');
}

$script = <<< "JS"
	
	function showMasterBuildingRoom(){var e,t,a={building_id:{url:AppMaster("getBuilding"),reload:!0}},l=mainTab.cells("master_building_room").attachLayout({pattern:"2U",cells:[{id:"a",header:!1},{id:"b",text:"Form Ruangan",header:!0,collapse:!0}]}),n=mainTab.cells("master_building_room").attachToolbar({icon_path:"./public/codebase/icons/",items:[{id:"refresh",text:"Refresh",type:"button",img:"refresh.png"},{id:"add",text:"Tambah",type:"button",img:"add.png"},{id:"delete",text:"Hapus",type:"button",img:"delete.png"},{id:"edit",text:"Ubah",type:"button",img:"edit.png",img_disabled:"edit_disabled.png"},{id:"searchtext",text:"Cari : ",type:"text"},{id:"search",text:"",type:"buttonInput",width:150}]});"admin"!==userLogged.role&&n.disableItem("delete");var r=l.cells("a").attachStatusBar();function s(){let e=i.getRowsNum();r.setText("Total baris: "+e)}var i=l.cells("a").attachGrid();function o(){l.cells("a").progressOn(),i.clearAndLoad(AppMaster("buildRoomGrid",{search:n.getValue("search")}),s)}i.setHeader("No,Nama Ruangan,Nama Gedung,Created By,Updated By,DiBuat"),i.attachHeader("#rspan,#text_filter,#select_filter,#text_filter,#text_filter,#text_filter"),i.setColSorting("str,str,str,str,str,str"),i.setColTypes("rotxt,rotxt,rotxt,rotxt,rotxt,rotxt"),i.setColAlign("center,left,left,left,left,left"),i.setInitWidthsP("5,20,20,15,15,25"),i.enableSmartRendering(!0),i.enableMultiselect(!0),i.attachEvent("onXLE",(function(){l.cells("a").progressOff()})),i.init(),o(),n.attachEvent("onClick",(function(r){switch(r){case"refresh":n.setValue("search",""),o();break;case"add":l.cells("b").expand(),l.cells("b").showView("tambah_building_room"),(e=l.cells("b").attachForm([{type:"fieldset",offsetTop:30,offsetLeft:30,label:"Tambah Ruangan",list:[{type:"combo",name:"building_id",label:"Nama Gedung",readonly:!0,required:!0,labelWidth:130,inputWidth:250},{type:"input",name:"name",label:"Nama Ruangan",labelWidth:130,inputWidth:250,required:!0},{type:"block",offsetTop:30,list:[{type:"button",name:"add",className:"button_add",offsetLeft:15,value:"Tambah"},{type:"newcolumn"},{type:"button",name:"clear",className:"button_clear",offsetLeft:30,value:"Clear"},{type:"newcolumn"},{type:"button",name:"cancel",className:"button_no",offsetLeft:30,value:"Cancel"}]}]}])).getCombo("building_id").load(AppMaster("getBuilding")),e.attachEvent("onButtonClick",(function(t){switch(t){case"add":if(!e.validate())return eAlert("Input error!");setDisable(["add","clear"],e,l.cells("b"));let t=new dataProcessor(AppMaster("buildRoomForm"));t.init(e),e.save(),t.attachEvent("onAfterUpdate",(function(t,n,r,s){let i=s.getAttribute("message");switch(n){case"inserted":sAlert("Berhasil Menambahkan Record <br>"+i),o(),clearAllForm(e,a),setEnable(["add","clear"],e,l.cells("b"));break;case"error":eAlert("Gagal Menambahkan Record <br>"+i),setEnable(["add","clear"],e,l.cells("b"))}}));break;case"clear":clearAllForm(e,a);break;case"cancel":l.cells("b").collapse()}}));break;case"delete":reqAction(i,AppMaster("buildRoomDelete"),1,((e,t)=>{o(),t.mSuccess&&sAlert("Sukses Menghapus Record <br>"+t.mSuccess),t.mError&&eAlert("Gagal Menghapus Record <br>"+t.mError)}));break;case"edit":!function(){if(!i.getSelectedRowId())return eAlert("Pilih baris yang akan diubah!");l.cells("b").expand(),l.cells("b").showView("edit_building_room"),t=l.cells("b").attachForm([{type:"fieldset",offsetTop:30,offsetLeft:30,label:"Ubah Ruangan",list:[{type:"hidden",name:"id",label:"ID",readonly:!0},{type:"combo",name:"building_id",label:"Nama Gedung",readonly:!0,required:!0,labelWidth:130,inputWidth:250},{type:"input",name:"name",label:"Nama Ruangan",labelWidth:130,inputWidth:250,required:!0},{type:"block",offsetTop:30,list:[{type:"button",name:"update",className:"button_update",offsetLeft:15,value:"Simpan"},{type:"newcolumn"},{type:"button",name:"cancel",className:"button_no",offsetLeft:30,value:"Cancel"}]}]}]),isFormNumeric(t,["file_limit"]);var e=t.getCombo("building_id");function a(){e.load(AppMaster("getBuilding",{select:t.getItemValue("building_id")}))}fetchFormData(AppMaster("buildRoomForm",{id:i.getSelectedRowId()}),t,null,null,a),t.attachEvent("onButtonClick",(function(e){switch(e){case"update":if(!t.validate())return eAlert("Input error!");setDisable(["update","cancel"],t,l.cells("b"));let e=new dataProcessor(AppMaster("buildRoomForm"));e.init(t),t.save(),e.attachEvent("onAfterUpdate",(function(e,a,n,r){let s=r.getAttribute("message");switch(a){case"updated":sAlert("Berhasil Mengubah Record <br>"+s),o(),l.cells("b").progressOff(),l.cells("b").showView("tambah_building_room"),l.cells("b").collapse();break;case"error":eAlert("Gagal Mengubah Record <br>"+s),setEnable(["update","cancel"],t,l.cells("b"))}}));break;case"cancel":o(),l.cells("b").collapse(),l.cells("b").showView("tambah_building_room")}}))}()}})),n.attachEvent("onEnter",(function(e){switch(e){case"search":o(),i.attachEvent("onGridReconstructed",s)}}))}

JS;

header('Content-Type: application/javascript');
echo $script;
