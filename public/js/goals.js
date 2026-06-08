document.addEventListener('DOMContentLoaded', ()=>{
  // Mobile sidebar support (if implemented in layout)
  const sidebarToggle = document.getElementById('sidebarToggle');
  if(sidebarToggle){
    sidebarToggle.addEventListener('click', ()=> document.body.classList.toggle('sidebar-open'))
  }

  // Simple toast helper
  window.showToast = (msg, timeout=3000)=>{
    let t = document.createElement('div'); t.className='toast align-items-center text-white bg-dark border-0'; t.role='alert'; t.style.position='fixed'; t.style.right='20px'; t.style.bottom='20px'; t.style.zIndex=9999; t.innerHTML = `<div class="d-flex"><div class="toast-body">${msg}</div><button type="button" class="btn-close btn-close-white ms-auto m-2" data-bs-dismiss="toast"></button></div>`;
    document.body.appendChild(t);
    setTimeout(()=> t.remove(), timeout);
  }
});
