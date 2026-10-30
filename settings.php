<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>YBVC • Settings Pro</title><script src="https://cdn.tailwindcss.com"></script><style>.glass{background:linear-gradient(135deg,rgba(255,255,255,.08),rgba(255,255,255,.02));backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,.08)}</style></head>
<body class="bg-[#060815] text-white flex min-h-screen">
<aside class="w-[300px] bg-[#0a0d1f]/80 backdrop-blur-xl border-r border-white/[0.06] p-7 flex flex-col fixed h-screen">
<div class="flex items-center gap-3.5"><img src="img/yllanna logo.png" class="w-[56px] h-[56px] rounded-2xl bg-white p-1 object-cover"><div><h2 class="font-black text-[17px]">YBVC</h2><p class="text-[10px] text-white/50">College of Computer Educ.</p></div></div>
<nav class="space-y-2 mt-12">
<a href="index.html" class="flex gap-3 text-white/50 px-4 py-3.5 rounded-2xl hover:bg-white/[0.06]">📊 Dashboard</a>
<a href="students.html" class="flex gap-3 text-white/50 px-4 py-3.5 rounded-2xl hover:bg-white/[0.06]">👥 Students</a>
<a href="grades.html" class="flex gap-3 text-white/50 px-4 py-3.5 rounded-2xl hover:bg-white/[0.06]">📝 Grades</a>
<a href="reports.html" class="flex gap-3 text-white/50 px-4 py-3.5 rounded-2xl hover:bg-white/[0.06]">📄 Reports</a>
<a href="settings.html" class="flex gap-3 bg-gradient-to-r from-[#2a5bda] to-[#3b6ef5] text-white px-4 py-3.5 rounded-2xl font-bold shadow-lg">⚙️ Settings</a>
</nav>
<div class="mt-auto glass p-4 rounded-[20px] flex items-center gap-3 border-yellow-400/20">
<img id="sideAvatar" src="img/admin.jpg" onerror="this.src='img/yllanna logo.png'" class="w-11 h-11 rounded-2xl object-cover border-2 border-yellow-400/50">
<div><p class="text-[13px] font-bold">Mohammad Salip</p><p class="text-[10px] text-white/40">System Admin • Online</p></div>
</div>
</aside>
<main class="flex-1 ml-[300px] p-10">
<h1 class="text-[34px] font-black">Settings</h1><p class="text-white/40 text-[13px] mt-1">System configuration • Pro v2.1 • Admin: Mohammad Salip</p>
<div class="grid grid-cols-2 gap-6 mt-8 max-w-[800px]">
<div class="glass p-8 rounded-[28px]"><h3 class="font-bold">🏫 Institution</h3><div class="mt-6 space-y-4"><div><label class="text-[10px] text-white/40 font-bold">SCHOOL NAME</label><input id="schoolName" value="YBVC College of Computer Education" class="w-full glass mt-2 px-4 py-3 rounded-2xl text-[13px] outline-none"></div><div><label class="text-[10px] text-white/40 font-bold">SCHOOL YEAR</label><input id="schoolYear" value="2023-2024" class="w-full glass mt-2 px-4 py-3 rounded-2xl text-[13px]"></div></div></div>
<div class="glass p-8 rounded-[28px]">
<h3 class="font-bold">👨‍💻 Admin Profile</h3>
<div class="flex items-center gap-4 mt-6">
<img id="mainAvatar" src="img/lip.jpg" onerror="this.src='img/yllanna logo.png'" alt="Mohammad Salip" class="w-20 h-20 rounded-[20px] object-cover border-2 border-yellow-400 shadow-[0_0_20px_rgba(255,215,0,.3)]">
<div>
<p class="font-black text-[16px]">Mohammad Salip</p>
<p class="text-[11px] text-white/40 mt-1">mohammad@ybvc.edu.ph</p>
<p class="text-[10px] text-green-400 mt-1 font-bold">● Online • Super Admin</p>
</div>
</div>
<input type="file" id="photoInput" accept="image/*" class="hidden">
<button id="changePhotoBtn" class="bg-white text-black w-full mt-6 py-3 rounded-2xl font-bold text-[13px]">Change Photo</button>
<p class="text-[10px] text-white/30 text-center mt-3">Upload new admin photo - auto saves</p>
</div>
</div>
<button id="saveAllBtn" class="bg-gradient-to-r from-[#2a5bda] to-[#3b6ef5] mt-8 px-8 py-4 rounded-2xl font-bold shadow-xl">Save All Settings</button>
</main>

<script>
// CHANGE PHOTO - WORKING
document.getElementById('changePhotoBtn').addEventListener('click', ()=>{
  document.getElementById('photoInput').click();
});

document.getElementById('photoInput').addEventListener('change', function(e){
  const file = e.target.files[0];
  if(!file) return;
  const url = URL.createObjectURL(file);
  document.getElementById('mainAvatar').src = url;
  document.getElementById('sideAvatar').src = url;
  // SAVE TO LOCALSTORAGE FOR ALL PAGES
  const reader = new FileReader();
  reader.onload = function(){ localStorage.setItem('ybvc_admin_photo', reader.result); };
  reader.readAsDataURL(file);
  alert('✅ Photo changed! - Saved sa tanan pages!');
});

// LOAD SAVED PHOTO ON ALL PAGES
const savedPhoto = localStorage.getItem('ybvc_admin_photo');
if(savedPhoto){
  document.getElementById('mainAvatar').src = savedPhoto;
  document.getElementById('sideAvatar').src = savedPhoto;
}

// SAVE SETTINGS - WORKING
document.getElementById('saveAllBtn').addEventListener('click', function(){
  const school = document.getElementById('schoolName').value;
  const year = document.getElementById('schoolYear').value;
  localStorage.setItem('ybvc_school', school);
  localStorage.setItem('ybvc_year', year);
  const btn = this;
  btn.textContent = '✓ Settings Saved!';
  btn.className = 'bg-white text-black mt-8 px-8 py-4 rounded-2xl font-bold shadow-xl';
  setTimeout(()=>{ btn.textContent='Save All Settings'; btn.className='bg-gradient-to-r from-[#2a5bda] to-[#3b6ef5] mt-8 px-8 py-4 rounded-2xl font-bold shadow-xl'; },2000);
});
</script>
<style>@media(max-width:768px){aside{display:none !important} main{margin-left:0 !important; padding:20px !important} .grid-cols-2{grid-template-columns:1fr !important}} button{touch-action:manipulation; min-height:44px; cursor:pointer}</style>
</body></html>