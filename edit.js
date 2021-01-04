// functionality for the menues to edit, view, or create characters or items
function renderEdit(editIdx){
    $("#overlay").show();
    $("#edit").show();
    var character = characters[editIdx];
    $("#pname").val(character.pname);
    $("#race").val(character.race);
    $("#guild").val(character.guild);
    curId = character.id
    $.post("/caleb/api.php/item/readItems", function(data, status){
      if(status == "success"){
        $.each(JSON.parse(data), function(index, item){
          $('#itemList').append('<option value="'+item.id+'">'+item.iname+'</option>');
        });
      }
    });
  }
  function renderItemEdit(ieditIdx){
    $("#overlay").show();
    $("#editItem").show();
    var item = items[ieditIdx];
    $("#iname").val(item.iname);
    curId = item.id;
  }
  function closeEdit(){
    $("#overlay").hide();
    $("#edit").hide();
    $("#editItem").hide();
    $("#createPerson").hide();
    $("#createItm").hide();
    $("#readCharacter").hide();
    $('#charItems').remove();
  }
  function save(){
    var selectBox = document.getElementById("itemList");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    let saveobj = {
      'pname': $("#pname").val(),
      'race': $("#race").val(),
      'guild': $("#guild").val(),
      'id': curId,
      'item': selectedValue
    }
    $.post("/caleb/api.php/character/update/", saveobj, function(data, status){
      if(status == "success"){
        $("#message").val("Saved");
        renderTable(index, count);
        closeEdit();
      }
    });
  }
  function saveItem(){

    $.getJSON("/caleb/api.php/item/update/?iname="+$("#iname").val()+"&id="+curId, function(data, status){
      if(status == "success"){
        $("#imessage").val("Saved");
        renderItemTable();
        closeEdit();
      }
    });
  }
  function createCharacter(){
    $("#overlay").show();
    $("#createPerson").show();
    curId = create_UUID();
    $.post("/caleb/api.php/item/readItems", function(data, status){
      if(status == "success"){
        $.each(JSON.parse(data), function(index, item){
          $('#items').append('<option value="'+item.id+'">'+item.iname+'</option>');
        });
      }
    });
  }
  function createItm(){
    $("#overlay").show();
    $("#createItm").show();
    curId = create_UUID();
  }
  function create(){
    var selectBox = document.getElementById("items");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    let saveobj = {
      'pname': $("#cpname").val(),
      'race': $("#crace").val(),
      'guild': $("#cguild").val(),
      'id': curId,
      'item': selectedValue
    }
    $.post("/caleb/api.php/character/create/", saveobj, function(data, status){
      if(status == "success"){
        $("#message").val("Saved");
        renderTable(index, count);
        closeEdit();
      }
    });
  }
  function createItem(){
    $.getJSON("/caleb/api.php/item/create/?iname="+$("#ciname").val()+"&id="+curId, function(data, status){
      if(status == "success"){
        $("#imessage").val("Saved");
        renderItemTable();
        closeEdit();
      }
    });
  }
  function readCharacter(idx ,id){
    $.getJSON("/caleb/api.php/character/read/?id="+id, function(data,status){
      if(status == "success"){
        $("#rpname").text(characters[idx].pname);
        $("#rrace").text(characters[idx].race);
        $("#rguild").text(characters[idx].guild);
        var items;
        $.each(data, function(index, item){
          if(item == null){
            return false;
          }
          items += '<label>'+item.iname+', </label> ';
        });
        $("#charItms").append(items);
        $('#readCharacter').show();
        $("#overlay").show();
      }
    });
  }