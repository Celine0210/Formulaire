
const urlParams = new URLSearchParams(window.location.search);
const msg = document.getElementById("msg");

if (urlParams.has('param')) {
  const param = urlParams.get('param');
  switch(param) {
    case"1":
        msg.style.display="inline";
        msg.innerHTML="Vous êtes connecté";
        break;      
     case"2":
        msg.style.display="inline";
        msg.innerHTML="Erreur.Recommencé";
        break;
     case"3":
        msg.style.display="inline";
        msg.innerHTML="Ajout d'un compte";
        break;
    }   
    setTimeout(function () {
        msg.style.display="none"

    },5000);
}

