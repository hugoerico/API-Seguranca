const rota = "http://localhost/api/api/";

function listPipou() {
  let headers = new Headers();
  headers.append("Content-Type", "application/json; charset=UTF-8");

  let request = { 
      method: 'GET',
      headers: headers
  };

  fetch(rota+'read.php', request)
  .then(function(response) {
    return response.json();
  })
  .then(function(data) {
    $('#tabelaPipous').html("");
    if(data.peoples !== undefined){
      data.peoples.forEach(people => {
        console.log(people);
        let data = people.BirthDate.split(" ")[0].split('-');
        $('#tabelaPipous').append(`
        <tr id="${people.Id}">
          <td>${people.Id}</td>
          <td scope="row">${people.Name}</td>
          <td>${data[2]}/${data[1]}/${data[0]}</td>
          <td>${people.Salary}</td>
          <td>
            <a href="#pnlUpdate" onclick="openUpdate(${people.Id});" >edit</a>
            <a href="#pnlListPipous" onclick="deletePipou(${people.Id});" >delete</a>
          </td>
        </tr>
        `);
      });
    }
    else {
      $('#tabelaPipous').append(`
        <tr>
          <td colspan="5" class="text-center h5">No pipous found 😢.</td>
        </tr>
      `);
    }
  });
}

function insertPipou() {
  let headers = new Headers();
  headers.append("Content-Type", "application/json; charset=UTF-8");

  let data = $('#insertBirthDate').val().split("/");
  let body = {
    Name: $('#insertName').val(),
    BirthDate: `${data[2]}-${data[1]}-${data[0]}`,
    Salary: $('#insertSalary').val()
  };

  let request = { 
    method: 'POST',
    headers: headers,
    body: JSON.stringify(body)
  };

  fetch(rota+'insert.php', request)
  .then(function(response) {
    return response;
  })
  .then(function(data) {
    insertCancel();
    listPipou();
  });

}

function insertCancel(){
  $('#insertName').val('');
  $('#insertBirthDate').val('');
  $('#insertSalary').val('');
}

function openUpdate(id) {
    console.log(id);
    if(id != undefined){
      let headers = new Headers();
      headers.append("Content-Type", "application/json; charset=UTF-8");

      let request = { 
        method: 'POST',
        headers: headers
      };

    fetch(rota+'get.php?Id='+id, request)
    .then(function(response) {
      return response.json();
    })
    .then(function(data) {
      $('#updateName').val(data.Name);
      $('#updateBirthDate').val(data.BirthDate);
      $('#updateSalary').val(data.Salary);
      $('#btnUpdatePipou').attr("onclick", `updatePipou('${id}')`);
      $('#pnlUpdate').removeClass("d-none");
    });

    }
    else{
      $('#btnUpdatePipou').attr("onclick", "");
      updateCancel();
    }


}

function updatePipou(id) {
  let headers = new Headers();
  headers.append("Content-Type", "application/json; charset=UTF-8");

  let data = $('#updateBirthDate').val().split("/");
  let body = {
    Id : id,
    Name: $('#updateName').val(),
    BirthDate: `${data[2]}-${data[1]}-${data[0]}`,
    Salary: $('#updateSalary').val()
  };

  let request = { 
    method: 'UPDATE',
    headers: headers,
    body: JSON.stringify(body)
  };

  fetch(rota+'update.php', request)
  .then(function(response) {
    return response;
  })
  .then(function(data) {
    updateCancel();
    listPipou();
  });
}

function updateCancel(){
  $('#updateName').val("");
  $('#updateBirthDate').val("");
  $('#updateSalary').val("");
  $('#pnlUpdate').addClass("d-none");
  listPipou();
}

function deletePipou(id) {
  if(id != undefined){
    let headers = new Headers();
    headers.append("Content-Type", "application/json; charset=UTF-8");

    let request = { 
      method: 'DELETE',
      headers: headers
    };

  fetch(rota+'delete.php?Id='+id, request)
  .then(function(response) {
    return response.json();
  })
  .then(function(data) {
    updateCancel();
    listPipou();
  });

  }
}

listPipou();