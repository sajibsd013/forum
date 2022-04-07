let element = document.getElementsByTagName("body")[0];
element.setAttribute("id","root");


const autoReload = ()=>{
  let currentURL = window.location.href;
  let req = new XMLHttpRequest();
    req.open('GET',`${currentURL}`,true);
    req.send();
    req.onreadystatechange = ()=>{
      if(req.readyState == 4 && req.status == 200){
        document.getElementById('root').innerHTML = req.responseText;
      }
    }
}



// Routhing
let router = (pageURL)=>{
    let req = new XMLHttpRequest();
    req.open('GET',`${pageURL}`,true);
    req.send();
    req.onreadystatechange = ()=>{
      if(req.readyState == 4 && req.status == 200){
        document.getElementById('root').innerHTML = req.responseText;
        window.history.pushState({
           id:"",
           source: "JS",
        },"Router",pageURL)
      }
    }
}




// Window Back  
window.onpopstate = ()=>{
 autoReload();
}



// Profile page mark solved Section
let checkFunc = (thread_id)=>{
  let check = document.getElementById(`checkbox_${thread_id}`).checked;
  let req = new XMLHttpRequest();
  req.open('GET',`profile.php?id=${thread_id}&checkbox=${check}`,true);
  req.send();
  req.onreadystatechange = ()=>{
    if(req.readyState == 4 && req.status == 200){
      document.getElementById('root').innerHTML = req.responseText;
      
    }
  }
}


// // submitSearchForm

// let SearchForm = document.getElementById("SearchForm");
// SearchForm.onsubmit =(e)=>{
//   e.preventDefault();

//   let value = document.getElementById("search").value;
//   let url = `search.php?search=${value}`;
//   let req = new XMLHttpRequest();
//   req.open('GET',url,true);
//   req.send();
//   req.onreadystatechange = ()=>{
//     if(req.readyState == 4 && req.status == 200){
//       document.getElementById('root').innerHTML = req.responseText;
//       window.history.pushState({
//         id:"",
//         source: "JS",
//      },"Router",url)
//     }
//   }
// }




