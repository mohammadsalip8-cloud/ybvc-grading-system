<?php
include 'config.php';
$total = $conn->query("SELECT COUNT(*) as c FROM students")->fetch_assoc()['c'];
$passed = $conn->query("SELECT COUNT(*) as c FROM students WHERE status='PASSED'")->fetch_assoc()['c'];
$failed = $total - $passed;
$rate = $total > 0 ? round(($passed/$total)*100,1) : 0;
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>YBVC • Pro Grading System</title><script src="https://cdn.tailwindcss.com"></script><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"><style>*{font-family:Inter}.glass{background:linear-gradient(135deg,rgba(255,255,255,0.08),rgba(255,255,255,0.02));backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.08)}.card-hover{transition:all .3s cubic-bezier(.4,0,.2,1)}.card-hover:hover{transform:translateY(-4px);box-shadow:0 20px 40px rgba(0,0,0,.4)}.shimmer{position:relative;overflow:hidden}.shimmer::after{content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,.1),transparent);animation:shimmer 2.5s infinite}@keyframes shimmer{100%{left:100%}}</style></head>
<body class="bg-[#060815] text-white flex min-h-screen">
<aside class="w-[300px] bg-[#0a0d1f]/80 backdrop-blur-xl border-r border-white/[0.06] p-7 flex flex-col fixed h-screen z-20">
<div class="flex items-center gap-3.5"><div class="relative"><img src="img/yllanna logo.png" class="w-[56px] h-[56px] rounded-2xl object-cover bg-white p-1 shadow-[0_0_30px_rgba(255,215,0,.3)]"><div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-[#0a0d1f]"></div></div><div><h2 class="font-black text-[17px] tracking-tight">YBVC</h2><p class="text-[11px] text-white/60 font-medium">College of Computer</p><p class="text-[8px] tracking-[0.2em] text-yellow-400 font-bold mt-0.5">INNOVATE • CODE • CREATE</p></div></div>
<p class="text-[10px] tracking-[0.3em] text-white/30 mt-12 mb-4 font-bold">MAIN MENU</p>
<nav class="space-y-2">
<a href="index.php" class="flex items-center gap-3.5 bg-gradient-to-r from-[#2a5bda] to-[#3b6ef5] text-white px-4 py-3.5 rounded-2xl font-bold text-[13px] shadow-[0_8px_20px_rgba(42,91,218,.4)]"><span class="w-7 h-7 bg-white/20 rounded-xl flex items-center justify-center">📊</span> Dashboard <span class="ml-auto w-2 h-2 bg-white rounded-full animate-pulse"></span></a>
<a href="students.php" class="flex items-center gap-3.5 text-white/50 hover:text-white hover:bg-white/[0.06] px-4 py-3.5 rounded-2xl text-[13px] font-medium"><span class="w-7 h-7 bg-white/[0.06] rounded-xl flex items-center justify-center">👥</span> Students</a>
<a href="grades.php" class="flex items-center gap-3.5 text-white/50 hover:text-white hover:bg-white/[0.06] px-4 py-3.5 rounded-2xl text-[13px] font-medium"><span class="w-7 h-7 bg-white/[0.06] rounded-xl flex items-center justify-center">📝</span> Grades</a>
<a href="reports.php" class="flex items-center gap-3.5 text-white/50 hover:text-white hover:bg-white/[0.06] px-4 py-3.5 rounded-2xl text-[13px] font-medium"><span class="w-7 h-7 bg-white/[0.06] rounded-xl flex items-center justify-center">📄</span> Reports</a>
</nav>
<div class="mt-auto glass p-4 rounded-[20px] flex items-center gap-3.5 card-hover border-yellow-400/20"><img src="img/lip.jpg" onerror="this.src='img/yllanna logo.png'" alt="Mohammad Salip" class="w-11 h-11 rounded-2xl object-cover border-2 border-yellow-400/50 shadow-lg"><div class="flex-1"><p class="text-[13px] font-bold leading-none">Mohammad Salip</p><p class="text-[10px] text-white/40 mt-1.5">Super Admin • <?php echo $total; ?> Students</p></div><div class="w-2 h-2 bg-green-500 rounded-full animate-pulse ml-auto"></div></div>
<p class="text-[9px] text-white/20 text-center mt-4">© 2024 YBVC Grading v2.1 Pro • DB: grading_system</p>
</aside>

<main class="flex-1 ml-[300px] p-10">
<div class="flex justify-between items-start"><div><div class="flex items-center gap-3"><h1 class="text-[34px] font-black tracking-tight">Grading System</h1><span class="bg-gradient-to-r from-yellow-400 to-orange-400 text-black text-[10px] font-black px-3 py-1 rounded-full">PRO + DATABASE</span></div><p class="text-[13px] text-white/40 mt-1 flex items-center gap-2"><span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Academic Year 2023-2024 • Live from grading_system • Admin: Mohammad</p></div><div class="flex items-center gap-3"><div class="glass px-5 py-3 rounded-full flex items-center gap-3"><span class="text-white/40">🔍</span><input id="searchInput" placeholder="Search LRN, name..." class="bg-transparent outline-none text-[13px] w-[260px] placeholder:text-white/30"></div></div></div>

<div class="grid grid-cols-3 gap-6 mt-10">
<div class="glass p-7 rounded-[28px] card-hover shimmer"><div class="flex justify-between"><p class="text-white/40 text-[12px] font-bold tracking-widest">TOTAL STUDENTS</p><div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center">👥</div></div><h2 class="text-[48px] font-black mt-4 tracking-tight"><?php echo $total; ?></h2><div class="flex items-center gap-2 mt-3"><span class="bg-green-500/20 text-green-400 text-[11px] font-bold px-2.5 py-1 rounded-full">LIVE DB ↑</span><p class="text-white/30 text-[11px]">from grading_system</p></div></div>
<div class="glass p-7 rounded-[28px] card-hover shimmer"><div class="flex justify-between"><p class="text-white/40 text-[12px] font-bold tracking-widest">PASSED RATE</p><div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center">✅</div></div><h2 class="text-[48px] font-black mt-4 tracking-tight"><?php echo $rate; ?><span class="text-[24px] text-white/40">%</span></h2><div class="w-full bg-white/10 h-2 rounded-full mt-4 overflow-hidden"><div class="h-full bg-gradient-to-r from-green-400 to-emerald-500 rounded-full" style="width:<?php echo $rate; ?>%"></div></div><p class="text-green-400 text-[11px] mt-3 font-bold"><?php echo $passed; ?> Students Passed</p></div>
<div class="glass p-7 rounded-[28px] card-hover shimmer"><div class="flex justify-between"><p class="text-white/40 text-[12px] font-bold tracking-widest">NEEDS ATTENTION</p><div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-2xl flex items-center justify-center">⚠️</div></div><h2 class="text-[48px] font-black mt-4 tracking-tight"><?php echo $failed; ?></h2><div class="flex items-center gap-2 mt-3"><span class="bg-red-500/20 text-red-400 text-[11px] font-bold px-2.5 py-1 rounded-full"><?php echo $total>0 ? round(($failed/$total)*100,1) : 0; ?>% ↓</span><p class="text-white/30 text-[11px]">from database</p></div></div>
</div>

<div class="glass rounded-[28px] mt-8 overflow-hidden"><div class="p-8 flex justify-between items-center border-b border-white/[0.06]"><h3 class="text-[18px] font-bold">Student Performance • Live from MySQL</h3><a href="grades.php" class="bg-white text-black px-5 py-2 rounded-full text-[12px] font-bold">+ New Entry</a></div>
<table class="w-full text-[13px]"><thead><tr class="text-[10px] text-white/30 border-b border-white/[0.06]"><th class="py-4 pl-8 text-left tracking-widest">LRN</th><th class="text-left tracking-widest">STUDENT</th><th class="text-left tracking-widest">Q1-Q2-Q3</th><th class="text-left tracking-widest">FINAL</th><th class="text-left tracking-widest">STATUS</th></tr></thead>
<tbody id="gradeTable" class="divide-y divide-white/[0.04]">
<?php
$result = $conn->query("SELECT * FROM students ORDER BY id DESC");
while($row = $result->fetch_assoc()){
  $initials = substr($row['full_name'],0,2);
  $color = $row['status']=='PASSED' ? 'bg-[#2a5bda]' : 'bg-red-500/80';
  $badge = $row['status']=='PASSED' ? 'bg-green-500/15 text-green-400 border-green-500/20' : 'bg-red-500/15 text-red-400 border-red-500/20';
  echo "<tr class='hover:bg-white/[0.02] transition'><td class='py-5 pl-8 text-white/60'>{$row['lrn']}</td><td><div class='flex items-center gap-3'><div class='w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-[10px] font-bold'>{$initials}</div><div><p class='font-semibold'>{$row['full_name']}</p><p class='text-[11px] text-white/30'>{$row['course']}</p></div></div></td><td class='text-white/50 text-[11px]'>{$row['q1']} | {$row['q2']} | {$row['q3']}</td><td><span class='{$color} px-4 py-1.5 rounded-full font-bold'>{$row['final_grade']}</span></td><td><span class='{$badge} border px-3 py-1 rounded-full text-[10px] font-bold'>● {$row['status']}</span></td></tr>";
}
?>
</tbody></table></div>
</main>
<script>document.getElementById('searchInput')?.addEventListener('input',e=>{let f=e.target.value.toLowerCase();document.querySelectorAll('#gradeTable tr').forEach(r=>{r.style.display=r.textContent.toLowerCase().includes(f)?'':'none'})})</script>
</body></html>