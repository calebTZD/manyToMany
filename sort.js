
function sortByName(){
    index = 0;
    if(sortedByName == true){
      sortedByName = false;
      sortedByRace = false;
      sortedByClass = false;
      nameDown = true;
      raceDown = false;
      classDown = false;
      getSortedTable()
    }
    else{
      sortedByName = true;
      sortedByRace = false;
      sortedByClass = false;
      nameDown = true;
      raceDown = false;
      classDown = false;
      getSortedTable();
    }
  }
  function sortByRace(idx=0, cnt=25){
    index = 0;
    if(sortedByRace == true){
      sortedByName = false;
      sortedByRace = false;
      sortedByClass = false;
      nameDown = false;
      raceDown = true;
      classDown = false;
      getSortedTable();
    }
    else{
      sortedByName = false;
      sortedByRace = true;
      sortedByClass = false;
      nameDown = false;
      raceDown = false;
      classDown = false;
      getSortedTable();
    }
  }
  
  function sortByClass(idx=0, cnt=25){
    index = 0;
    if(sortedByClass == true){
      sortedByName = false;
      sortedByRace = false;
      sortedByClass = false;
      nameDown = false;
      raceDown = false;
      classDown = true;
      getSortedTable();
    }
    else{
      sortedByName = false;
      sortedByRace = false;
      sortedByClass = true;
      nameDown = false;
      raceDown = false;
      classDown = false;
      getSortedTable();
    }
  }

  function renderSearchTable(idx, cnt){
    $.getJSON("/caleb/api.php/character/search/?idx="+idx+"&cnt="+cnt+"&pstr="+$('#searchbar').val() , function(data, status){
        if (status == "success"){
          characters = data;
          var rows = '<tr><th><button type="button" class="btn" onclick="sortByName()">Name</button><div id="charUp"></div><div id="charDown"></div></th><th><button class="btn" onclick="sortByRace()">Race</button><div id="raceUp"></div><div id="raceDown"></div></th><th><button class="btn"  onclick="sortByClass()">Class</button><div id="classUp"></div><div id="classDown"></div></th></tr>';
          $.each (data, function(index, item){
            rows += '<tr><td><button type="button" class="btn" onclick="readCharacter('+index+','+item.id+')">' + item.pname + '</button></td><td>' + item.race + '</td><td>' + item.guild + '</td><td><button onclick="renderEdit('+ index +')" class="btn">Edit</button></td><td><button onclick="deleteCharacter('+ item.id +')" class="btn">delete</button></td></tr>';
          });
        $('#ctab').html(rows);
        $('#itemNumbers').html((idx+1) + '-' + (idx + cnt));
       }
    });
  }
  
function getSortedTable(idx = 0, cnt = 25){
  if(sortedByName == true){
    renderTable(idx,cnt);
  }
  else if(nameDown == true){
    $.getJSON("/caleb/api.php/character/sortCharDown/?idx="+idx+"&cnt="+ cnt , function(data, status){
          if (status == "success"){
            characters = data;
              var rows = '<tr><th><button class="btn" onclick="sortByName()">Name</button><div id="charUp"></div><div id="charDown"></div></th><th><button class="btn" onclick="sortByRace()">Race</button><div id="raceUp"></div><div id="raceDown"></div></th><th><button class="btn" onclick="sortByClass()">Class</button><div id="classUp"></div><div id="classDown"></div></th></tr>';
              $.each (data, function(index, item){
                rows += '<tr><td><button type="button" class="btn" onclick="readCharacter('+index+','+item.id+')">' + item.pname + '</button></td><td>' + item.race + '</td><td>' + item.guild + '</td><td><button onclick="renderEdit('+ index +')" class="btn">Edit</button></td><td><button onclick="deleteCharacter('+ item.id +')" class="btn">delete</button></td></tr>';
              });
              $('#ctab').html(rows);
              $('#itemNumbers').html((idx+1) + '-' + (idx + cnt));
              $('#buttonWrapper').show();
              $('#create').show();
              $('#createItem').hide();
              $('#editItem').hide();
              $('#createPerson').hide();
              $('#createItm').hide();
              $('#readCharacter').hide();
              $('#charUp').hide();
              $('#charDown').show();
              $('#raceUp').hide();
              $('#raceDown').hide();
              $('#classUp').hide();
              $('#classDown').hide();
          }
      });

  }
  else if(raceDown == true){
    $.getJSON("/caleb/api.php/character/sortRaceDown/?idx="+idx+"&cnt="+ cnt , function(data, status){
          if (status == "success"){
            characters = data;
            var rows = '<tr><th><button class="btn" onclick="sortByName()">Name</button><div id="charUp"></div><div id="charDown"></div></th><th><button class="btn" onclick="sortByRace()">Race</button><div id="raceUp"></div><div id="raceDown"></div></th><th><button class="btn" onclick="sortByClass()">Class</button><div id="classUp"></div><div id="classDown"></div></th></tr>';
            $.each (data, function(index, item){
              rows += '<tr><td><button type="button" class="btn" onclick="readCharacter('+index+','+item.id+')">' + item.pname + '</button></td><td>' + item.race + '</td><td>' + item.guild + '</td><td><button onclick="renderEdit('+ index +')" class="btn">Edit</button></td><td><button onclick="deleteCharacter('+ item.id +')" class="btn">delete</button></td></tr>';
            });
              $('#ctab').html(rows);
              $('#itemNumbers').html((idx+1) + '-' + (idx + cnt));
              $('#buttonWrapper').show();
              $('#create').show();
              $('#createItem').hide();
              $('#editItem').hide();
              $('#createPerson').hide();
              $('#createItm').hide();
              $('#readCharacter').hide();
              $("#charUp").hide();
              $("#charDown").hide();
              $("#raceUp").hide();
              $("#raceDown").show();
              $("#classUp").hide();
              $("#classDown").hide();
          }
      });
   
  }
  else if(sortedByRace == true){
    $.getJSON("/caleb/api.php/character/sortRaceUp/?idx="+idx+"&cnt="+ cnt , function(data, status){
          if (status == "success"){
            characters = data;
            var rows = '<tr><th><button class="btn" onclick="sortByName()">Name</button><div id="charUp"></div><div id="charDown"></div></th><th><button class="btn" onclick="sortByRace()">Race</button><div id="raceUp"></div><div id="raceDown"></div></th><th><button class="btn" onclick="sortByClass()">Class</button><div id="classUp"></div><div id="classDown"></div></th></tr>';
            $.each (data, function(index, item){
              rows += '<tr><td><button type="button" class="btn" onclick="readCharacter('+index+','+item.id+')">' + item.pname + '</button></td><td>' + item.race + '</td><td>' + item.guild + '</td><td><button onclick="renderEdit('+ index +')" class="btn">Edit</button></td><td><button onclick="deleteCharacter('+ item.id +')" class="btn">delete</button></td></tr>';
            });
              $('#ctab').html(rows);
              $('#itemNumbers').html((idx+1) + '-' + (idx + cnt));
              $('#buttonWrapper').show();
              $('#create').show();
              $('#createItem').hide();
              $('#editItem').hide();
              $('#createPerson').hide();
              $('#createItm').hide();
              $('#readCharacter').hide();
              $("#charUp").hide();
              $("#charDown").hide();
              $("#raceUp").show();
              $("#raceDown").hide();
              $("#classUp").hide();
              $("#classDown").hide();
          }
      });

  }
  else if(sortedByClass == true){
    $.getJSON("/caleb/api.php/character/sortClassUp/?idx="+idx+"&cnt="+ cnt , function(data, status){
          if (status == "success"){
            characters = data;
            var rows = '<tr><th><button class="btn" onclick="sortByName()">Name</button><div id="charUp"></div><div id="charDown"></div></th><th><button class="btn" onclick="sortByRace()">Race</button><div id="raceUp"></div><div id="raceDown"></div></th><th><button class="btn" onclick="sortByClass()">Class</button><div id="classUp"></div><div id="classDown"></div></th></tr>';
            $.each (data, function(index, item){
              rows += '<tr><td><button type="button" class="btn" onclick="readCharacter('+index+','+item.id+')">' + item.pname + '</button></td><td>' + item.race + '</td><td>' + item.guild + '</td><td><button onclick="renderEdit('+ index +')" class="btn">Edit</button></td><td><button onclick="deleteCharacter('+ item.id +')" class="btn">delete</button></td></tr>';
            });
              $('#ctab').html(rows);
              $('#itemNumbers').html((idx+1) + '-' + (idx + cnt));
              $('#buttonWrapper').show();
              $('#create').show();
              $('#createItem').hide();
              $('#editItem').hide();
              $('#createPerson').hide();
              $('#createItm').hide();
              $('#readCharacter').hide();
              $("#charUp").hide();
              $("#charDown").hide();
              $("#raceUp").hide();
              $("#raceDown").hide();
              $("#classUp").show();
              $("#classDown").hide();
          }
      });
  }
  else if(classDown == true){
    $.getJSON("/caleb/api.php/character/sortClassDown/?idx="+idx+"&cnt="+ cnt , function(data, status){
          if (status == "success"){
            characters = data;
            var rows = '<tr><th><button class="btn" onclick="sortByName()">Name</button><div id="charUp"></div><div id="charDown"></div></th><th><button class="btn" onclick="sortByRace()">Race</button><div id="raceUp"></div><div id="raceDown"></div></th><th><button class="btn" onclick="sortByClass()">Class</button><div id="classUp"></div><div id="classDown"></div></th></tr>';
            $.each (data, function(index, item){
              rows += '<tr><td><button type="button" class="btn" onclick="readCharacter('+index+','+item.id+')">' + item.pname + '</button></td><td>' + item.race + '</td><td>' + item.guild + '</td><td><button onclick="renderEdit('+ index +')" class="btn">Edit</button></td><td><button onclick="deleteCharacter('+ item.id +')" class="btn">delete</button></td></tr>';
            });
              $('#ctab').html(rows);
              $('#itemNumbers').html((idx+1) + '-' + (idx + cnt));
              $('#buttonWrapper').show();
              $('#create').show();
              $('#createItem').hide();
              $('#editItem').hide();
              $('#createPerson').hide();
              $('#createItm').hide();
              $('#readCharacter').hide();
              $("#charUp").hide();
              $("#charDown").hide();
              $("#raceUp").hide();
              $("#raceDown").hide();
              $("#classUp").hide();
              $("#classDown").show();
          }
      });
  }
}