// admin.js - small helpers
document.addEventListener('click', function(e){
    if(e.target.matches('[data-confirm]')){
      const msg = e.target.getAttribute('data-confirm') || 'Bạn chắc chắn?';
      if(!confirm(msg)) e.preventDefault();
    }
  });
  