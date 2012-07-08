(function(){
  var onglets, contenu_onglets, onglet, __i, __len;
  onglets = document.getElementsByClassName('onglet');
  contenu_onglets = document.getElementsByClassName('contenu_onglet');
  function showOnglet(name){
    var contenu_onglet, input, onglet, __i, __ref, __len, __j, __ref1, __len1;
    for (__i = 0, __len = (__ref = contenu_onglets).length; __i < __len; ++__i) {
      contenu_onglet = __ref[__i];
      if (contenu_onglet.dataset.onglet === name) {
        contenu_onglet.style.display = 'block';
      } else {
        contenu_onglet.style.display = 'none';
      }
      for (__j = 0, __len1 = (__ref1 = contenu_onglet.getElementsByTagName('input')).length; __j < __len1; ++__j) {
        input = __ref1[__j];
        input.value = '';
      }
    }
    for (__i = 0, __len = (__ref = onglets).length; __i < __len; ++__i) {
      onglet = __ref[__i];
      if (onglet.dataset.onglet === name) {
        onglet.style.color = 'blue';
      } else {
        onglet.style.color = 'black';
      }
    }
  }
  if (onglets.length) {
    showOnglet(onglets[0].dataset.onglet);
    for (__i = 0, __len = onglets.length; __i < __len; ++__i) {
      onglet = onglets[__i];
      onglet.onclick = __fn;
    }
  }
  function __fn(){
    return showOnglet(this.dataset.onglet);
  }
}).call(this);
