async function conector(params) {
  const config = {
    method: "POST",
    mode: "cors",
    cache: "default",
    body: JSON.stringify(params),
    mode: "same-origin",
    credentials: "same-origin",
    headers: {
      'Accept':'application/json',
      'Content-Type':'application/json'
    }
  }
  
  fetch("./api.php", config).then(data=>{
    console.log(data);
    return data.json()
  });

}

async function getScriptList() {
  const formData= new FormData()
  formData.append("route", "ScriptList");

  const scriptList = await conector({
    route: "ScriptList"
  });

  console.log(scriptList)
}

