<?php
include 'config.php';

// SAVE GRADE
if(isset($_POST['save_grade'])){
  $id = intval($_POST['student_id']);
  $q1 = intval($_POST['q1']);
  $q2 = intval($_POST['q2']);
  $q3 = intval($_POST['q3']);
  // DepEd: 20% 20% 60%
  $final = round($q1*0.2 + $q2*0.2 + $q3*0.6);
  $status = $final >= 75 ? 'PASSED' : 'FAILED';
  $conn->query("UPDATE students SET q1=$q1, q2=$q2, q3=$q3, final_grade=$final, status='$status' WHERE id=$id");
  header("Location: grades.php?saved=1&id=$id");
  exit;
}

$students = $conn->query("SELECT * FROM students ORDER BY full_name ASC");
$selected = null;
if(isset($_GET['id'])){
  $sid = intval($_GET['id']);
  $res = $conn->query("SELECT * FROM students WHERE id=$sid");
  $selected = $res->fetch_assoc();
}
$saved = isset($_GET['saved']);
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>YBVC • Grades Pro</title><script src="https://cdn.tailwindcss.com"></script><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet"><style>*{font-family:Inter}.glass{background:linear-gradient(135deg,rgba(255,255,255,.08),rgba(255,255,255,.02));backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,.08)}</style></head>
<body class="bg-[#060815] text-white flex min-h-screen">
<aside class="w-[300px] bg-[#0a0d1f]/80 backdrop-blur-xl border-r border-white/[0.06] p-7 flex flex-col fixed h-screen">
<div class="flex items-center gap-3.5"><img src="img/yllanna logo.png" class="w-[56px] h-[56px] rounded-2xl bg-white p-1 object-cover"><div><h2 class="font-black text-[17px]">YBVC</h2><p class="text-[10px] text-white/40">College of Computer</p></div></div>
<nav class="space-y-2 mt-12">
<a href="index.php" class="flex gap-3 text-white/50 px-4 py-3.5 rounded-2xl hover:bg-white/[0.06]">📊 Dashboard</a>
<a href="students.php" class="flex gap-3 text-white/50 px-4 py-3.5 rounded-2xl hover:bg-white/[0.06]">👥 Students</a>
<a href="grades.php" class="flex gap-3 bg-gradient-to-r from-[#2a5bda] to-[#3b6ef5] text-white px-4 py-3.5 rounded-2xl font-bold shadow-lg">📝 Grades</a>
<a href="reports.php" class="flex gap-3 text-white/50 px-4 py-3.5 rounded-2xl hover:bg-white/[0.06]">📄 Reports</a>
</nav>
<div class="mt-auto glass p-4 rounded-[20px] flex items-center gap-3 border-yellow-400/20"><img src="img/lip.jpg" onerror="this.src='img/yllanna logo.png'" class="w-11 h-11 rounded-2xl object-cover border-2 border-yellow-400/50"><div><p class="text-[13px] font-bold">Mohammad Salip</p><p class="text-[10px] text-white/40">Super Admin • Live DB</p></div><div class="ml-auto w-2 h-2 bg-green-500 rounded-full animate-pulse"></div></div>
</aside>

<main class="flex-1 ml-[300px] p-10">
<h1 class="text-[34px] font-black">Grades Entry</h1><p class="text-white/40 text-[13px] mt-1">Auto-compute final grade • DepEd Standard 20% 20% 60% • Save to grading_system</p>

<?php if($saved): ?>
<div class="mt-6 bg-green-500/15 border border-green-500/20 text-green-400 px-6 py-4 rounded-2xl text-[13px] font-bold">✓ Saved! Final grade updated sa database!</div>
<?php endif; ?>

<div class="glass rounded-[28px] p-8 mt-8">
<form method="GET" class="mb-8">
<label class="text-[10px] text-white/40 font-bold tracking-widest">SELECT STUDENT</label>
<div class="flex gap-3 mt-2">
<select name="id" onchange="this.form.submit()" class="glass flex-1 px-5 py-4 rounded-2xl text-[14px] bg-[#0a0d1f] border border-white/10 outline-none">
<option value="">-- Pili ug Student --</option>
<?php 
$students->data_seek(0);
while($s=$students->fetch_assoc()){
  $sel = $selected && $selected['id']==$s['id'] ? 'selected' : '';
  echo "<option value='{$s['id']}' $sel>{$s['full_name']} - {$s['lrn']} (Current: {$s['final_grade']})</option>";
}
?>
</select>
</div>
</form>

<?php if($selected): ?>
<form method="POST">
<input type="hidden" name="student_id" value="<?php echo $selected['id']; ?>">
<div class="flex items-center gap-4 mb-6 glass p-4 rounded-2xl">
<div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center font-bold"><?php echo strtoupper(substr($selected['full_name'],0,1)); ?></div>
<div><p class="font-bold text-[16px]"><?php echo $selected['full_name']; ?></p><p class="text-[11px] text-white/40"><?php echo $selected['lrn']; ?> • <?php echo $selected['course']; ?> • Current: <?php echo $selected['final_grade']; ?> - <?php echo $selected['status']; ?></p></div>
</div>

<div class="grid grid-cols-4 gap-5">
<div class="glass p-5 rounded-2xl"><label class="text-[10px] text-white/40 font-bold tracking-widest">1ST QUARTER • 20%</label><input name="q1" id="q1Input" type="number" min="0" max="100" value="<?php echo $selected['q1']; ?>" placeholder="0" class="w-full bg-transparent text-[32px] font-black mt-2 outline-none"></div>
<div class="glass p-5 rounded-2xl"><label class="text-[10px] text-white/40 font-bold tracking-widest">2ND QUARTER • 20%</label><input name="q2" id="q2Input" type="number" min="0" max="100" value="<?php echo $selected['q2']; ?>" placeholder="0" class="w-full bg-transparent text-[32px] font-black mt-2 outline-none"></div>
<div class="glass p-5 rounded-2xl"><label class="text-[10px] text-white/40 font-bold tracking-widest">3RD QUARTER • 60%</label><input name="q3" id="q3Input" type="number" min="0" max="100" value="<?php echo $selected['q3']; ?>" placeholder="0" class="w-full bg-transparent text-[32px] font-black mt-2 outline-none"></div>
<div class="glass p-5 rounded-2xl border-yellow-400/30 bg-yellow-400/[0.03]"><label class="text-[10px] text-yellow-400 font-bold tracking-widest">FINAL • AUTO</label><p id="finalDisplay" class="text-[42px] font-black mt-2">—</p></div>
</div>

<div class="flex gap-3 mt-8">
<button name="save_grade" class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-4 rounded-2xl font-bold shadow-lg hover:scale-[1.02] transition">💾 Save & Compute to DB</button>
<a href="grades.php" class="glass px-8 py-4 rounded-2xl font-bold text-center">Reset</a>
</div>
</form>

<?php else: ?>
<div class="text-center py-16 text-white/30">
<p class="text-[48px]">📝</p><p class="mt-4 text-[14px]">Pili sa ug student sa taas para maka input ug grades</p>
<p class="text-[11px] mt-2">Q1=20% Q2=20% Q3=60% = Final Grade auto compute</p>
</div>
<?php endif; ?>

</div>

<?php if($selected): ?>
<div class="glass rounded-[28px] p-6 mt-6">
<p class="text-[12px] font-bold text-white/60">QUICK PREVIEW • All Students</p>
<table class="w-full text-[12px] mt-4"><thead class="text-[10px] text-white/30 border-b border-white/[0.06]"><tr><th class="py-2 text-left">NAME</th><th>Q1 Q2 Q3</th><th>FINAL</th><th>STATUS</th></tr></thead><tbody class="divide-y divide-white/[0.04]">
<?php
$all = $conn->query("SELECT * FROM students ORDER BY final_grade DESC LIMIT 5");
while($r=$all->fetch_assoc()){
  echo "<tr class='hover:bg-white/[0.02]'><td class='py-3'>{$r['full_name']}</td><td class='text-center text-white/50'>{$r['q1']} | {$r['q2']} | {$r['q3']}</td><td class='text-center'><span class='bg-[#2a5bda] px-3 py-1 rounded-full'>{$r['final_grade']}</span></td><td class='text-center'><span class='text-[10px] ".($r['status']=='PASSED'?'text-green-400':'text-red-400')."'>● {$r['status']}</span></td></tr>";
}
?>
</tbody></table>
</div>
<?php endif; ?>

</main>

<script>
function computeGrade(){
  const v1=parseFloat(document.getElementById('q1Input')?.value)||0;
  const v2=parseFloat(document.getElementById('q2Input')?.value)||0;
  const v3=parseFloat(document.getElementById('q3Input')?.value)||0;
  const el=document.getElementById('finalDisplay');
  if(!el) return;
  if(v1==0&&v2==0&&v3==0){el.textContent='—'; el.className='text-[42px] font-black mt-2 text-white/20'; return;}
  const final=Math.round(v1*0.2+v2*0.2+v3*0.6);
  if(final>=75) el.innerHTML=final+' <span class="text-[11px] bg-green-500/20 text-green-400 px-3 py-1 rounded-full">PASSED</span>';
  else if(final>=60) el.innerHTML=final+' <span class="text-[11px] bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-full">REMEDIAL</span>';
  else el.innerHTML=final+' <span class="text-[11px] bg-red-500/20 text-red-400 px-3 py-1 rounded-full">FAILED</span>';
  el.className='text-[42px] font-black mt-2 '+(final>=75?'text-green-400':final>=60?'text-yellow-400':'text-red-400');
}
document.getElementById('q1Input')?.addEventListener('input',computeGrade);
document.getElementById('q2Input')?.addEventListener('input',computeGrade);
document.getElementById('q3Input')?.addEventListener('input',computeGrade);
computeGrade();
</script>
<style>@media(max-width:768px){aside{display:none!important}main{margin-left:0!important;padding:20px!important}.grid-cols-4{grid-template-columns:1fr 1fr!important}}</style>
</body></html>