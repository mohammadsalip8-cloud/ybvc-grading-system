<?php
include 'config.php';
$result = $conn->query("SELECT * FROM students ORDER BY full_name ASC");
$students = [];
$total=0; $passed=0;
if($result){
  while($r=$result->fetch_assoc()){ $students[]=$r; $total++; if($r['status']=='PASSED') $passed++; }
}
$rate = $total>0 ? round(($passed/$total)*100,1) : 0;
$failed = $total-$passed;
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>YBVC • Reports Pro</title><script src="https://cdn.tailwindcss.com"></script><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet"><style>*{font-family:Inter}.glass{background:linear-gradient(135deg,rgba(255,255,255,.08),rgba(255,255,255,.02));backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,.08)}.card-hover{transition:all .3s}.card-hover:hover{transform:translateY(-4px);box-shadow:0 20px 40px rgba(0,0,0,.4)}@media print{aside,.no-print{display:none!important}main{margin-left:0!important}}</style></head>
<body class="bg-[#060815] text-white flex min-h-screen">
<aside class="w-[300px] bg-[#0a0d1f]/80 backdrop-blur-xl border-r border-white/[0.06] p-7 flex flex-col fixed h-screen">
<div class="flex items-center gap-3.5"><img src="img/yllanna logo.png" class="w-[56px] h-[56px] rounded-2xl bg-white p-1 object-cover"><div><h2 class="font-black text-[17px]">YBVC</h2><p class="text-[10px] text-white/40">College of Computer</p></div></div>
<nav class="space-y-2 mt-12">
<a href="index.php" class="flex gap-3 text-white/50 px-4 py-3.5 rounded-2xl hover:bg-white/[0.06]">📊 Dashboard</a>
<a href="students.php" class="flex gap-3 text-white/50 px-4 py-3.5 rounded-2xl hover:bg-white/[0.06]">👥 Students</a>
<a href="grades.php" class="flex gap-3 text-white/50 px-4 py-3.5 rounded-2xl hover:bg-white/[0.06]">📝 Grades</a>
<a href="reports.php" class="flex gap-3 bg-gradient-to-r from-[#2a5bda] to-[#3b6ef5] text-white px-4 py-3.5 rounded-2xl font-bold shadow-lg">📄 Reports</a>
</nav>
<div class="mt-auto glass p-4 rounded-[20px] flex items-center gap-3 border-yellow-400/20"><img src="img/lip.jpg" onerror="this.src='img/yllanna logo.png'" class="w-11 h-11 rounded-2xl object-cover border-2 border-yellow-400/50"><div><p class="text-[13px] font-bold">Mohammad Salip</p><p class="text-[10px] text-white/40"><?php echo $total; ?> Students • Live DB</p></div><div class="ml-auto w-2 h-2 bg-green-500 rounded-full animate-pulse"></div></div>
</aside>

<main class="flex-1 ml-[300px] p-10">
<h1 class="text-[34px] font-black">Reports Center</h1><p class="text-white/40 text-[13px] mt-1">Export official DepEd documents • Live from grading_system • <?php echo $total; ?> Students • <?php echo $passed; ?> Passed (<?php echo $rate; ?>%)</p>

<div class="grid grid-cols-3 gap-6 mt-10 no-print">
<div class="glass p-8 rounded-[28px] card-hover"><div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-2xl flex items-center justify-center text-2xl">📄</div><h3 class="font-bold text-[18px] mt-5">Report Card</h3><p class="text-white/40 text-[12px] mt-2">Form 138 • <?php echo $total; ?> students</p><button id="reportCardBtn" class="bg-white text-black w-full mt-6 py-3 rounded-2xl font-bold text-[13px]">Generate PDF (Print)</button></div>
<div class="glass p-8 rounded-[28px] card-hover"><div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center text-2xl">📊</div><h3 class="font-bold text-[18px] mt-5">Class Record</h3><p class="text-white/40 text-[12px] mt-2">Excel CSV • All students LIVE</p><button id="classRecordBtn" class="glass w-full mt-6 py-3 rounded-2xl font-bold text-[13px]">Export Excel (<?php echo $total; ?> rows)</button></div>
<div class="glass p-8 rounded-[28px] card-hover border-yellow-400/20"><div class="w-14 h-14 bg-gradient-to-br from-yellow-400 to-orange-500 rounded-2xl flex items-center justify-center text-2xl">📑</div><h3 class="font-bold text-[18px] mt-5">Form 137</h3><p class="text-white/40 text-[12px] mt-2">Permanent Record • Official</p><button onclick="window.print()" class="bg-gradient-to-r from-yellow-400 to-orange-500 text-black w-full mt-6 py-3 rounded-2xl font-bold text-[13px]">Print Official Report</button></div>
</div>

<div class="glass rounded-[28px] p-8 mt-8">
<div class="flex justify-between items-center mb-6"><h3 class="font-bold text-[16px]">Official Class Record Preview • Live from DB</h3><span class="text-[10px] bg-white/10 px-3 py-1 rounded-full"><?php echo date('M d, Y h:i A'); ?></span></div>
<table class="w-full text-[13px]"><thead class="text-[10px] text-white/30 border-b border-white/[0.06]"><tr><th class="py-3 text-left">LRN</th><th class="text-left">FULL NAME</th><th>COURSE</th><th>Q1 20%</th><th>Q2 20%</th><th>Q3 60%</th><th>FINAL</th><th>STATUS</th></tr></thead><tbody class="divide-y divide-white/[0.04]">
<?php foreach($students as $row): ?>
<tr class="hover:bg-white/[0.02]"><td class="py-4 text-white/60"><?php echo $row['lrn']; ?></td><td class="font-semibold"><?php echo htmlspecialchars($row['full_name']); ?></td><td class="text-center"><span class="glass px-2 py-1 rounded-full text-[11px]"><?php echo $row['course']; ?></span></td><td class="text-center"><?php echo $row['q1']; ?></td><td class="text-center"><?php echo $row['q2']; ?></td><td class="text-center"><?php echo $row['q3']; ?></td><td class="text-center"><span class="bg-[#2a5bda] px-3 py-1 rounded-full font-bold"><?php echo $row['final_grade']; ?></span></td><td class="text-center"><span class="<?php echo $row['status']=='PASSED'?'text-green-400':'text-red-400'; ?> text-[11px]">● <?php echo $row['status']; ?></span></td></tr>
<?php endforeach; ?>
</tbody></table>
<?php if($total==0): ?><p class="text-center py-8 text-white/30">Wala pay students sa grading_system database. Add sa students.php</p><?php endif; ?>
<div class="mt-8 pt-6 border-t border-white/[0.06] flex justify-between text-[11px] text-white/30"><p>Prepared by: Mohammad Salip • Super Admin</p><p>YBVC College of Computer Studies • Total: <?php echo $total; ?> | Passed: <?php echo $passed; ?> | Failed: <?php echo $failed; ?> | Rate: <?php echo $rate; ?>%</p></div>
</div>

</main>

<script>
// LIVE DATA FROM PHP TO JS
const studentsData = <?php echo json_encode($students); ?>;

document.getElementById('reportCardBtn').addEventListener('click', function(){
  window.print();
});

document.getElementById('classRecordBtn').addEventListener('click', function(){
  const btn=this; btn.textContent='⏳ Exporting...';
  let csv = "LRN,Full Name,Course,Q1 (20%),Q2 (20%),Q3 (60%),Final Grade,Status,Date Exported\n";
  studentsData.forEach(s=>{
    csv += `"${s.lrn}","${s.full_name}","${s.course}",${s.q1},${s.q2},${s.q3},${s.final_grade},${s.status},"<?php echo date('Y-m-d H:i:s'); ?>"\n`;
  });
  csv += `\nSummary,Total: ${studentsData.length},Passed: ${studentsData.filter(s=>s.status=='PASSED').length},Failed: ${studentsData.filter(s=>s.status!='PASSED').length},Rate: ${<?php echo $rate; ?>}%\n`;
  setTimeout(()=>{
    const blob=new Blob([csv],{type:'text/csv;charset=utf-8;'});
    const url=URL.createObjectURL(blob);
    const a=document.createElement('a'); a.href=url; a.download=`YBVC_ClassRecord_LIVE_${new Date().toISOString().slice(0,10)}.csv`; a.click();
    btn.textContent='✓ Excel Exported! LIVE DB!';
    setTimeout(()=>btn.textContent=`Export Excel (${studentsData.length} rows)`,2000);
  },600);
});
</script>
<style>@media(max-width:768px){aside{display:none!important}main{margin-left:0!important;padding:20px!important}.grid-cols-3{grid-template-columns:1fr!important}}</style>
</body></html>