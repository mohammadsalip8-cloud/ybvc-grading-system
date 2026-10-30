<?php
include 'config.php';

// DELETE
if(isset($_GET['delete'])){
  $id = intval($_GET['delete']);
  $conn->query("DELETE FROM students WHERE id=$id");
  header("Location: students.php");
  exit;
}

// ADD / UPDATE
if(isset($_POST['save'])){
  $lrn = $_POST['lrn'];
  $name = $_POST['full_name'];
  $course = $_POST['course'];
  $id = $_POST['id'] ?? '';

  // default grades 0 if wala pa
  $q1=0; $q2=0; $q3=0; $final=0;
  $status='Active';

  if($id!=''){
    $conn->query("UPDATE students SET lrn='$lrn', full_name='$name', course='$course' WHERE id=$id");
  } else {
    $conn->query("INSERT INTO students (lrn, full_name, course, q1, q2, q3, final_grade, status) VALUES ('$lrn','$name','$course',$q1,$q2,$q3,$final,'$status')");
  }
  header("Location: students.php");
  exit;
}

$result = $conn->query("SELECT * FROM students ORDER BY id DESC");
$count = $result ? $result->num_rows : 0;
?>
<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>YBVC • Students Pro</title><script src="https://cdn.tailwindcss.com"></script><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet"><style>*{font-family:Inter}.glass{background:linear-gradient(135deg,rgba(255,255,255,.08),rgba(255,255,255,.02));backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,.08)}</style></head>
<body class="bg-[#060815] text-white flex min-h-screen">
<aside class="w-[300px] bg-[#0a0d1f]/80 backdrop-blur-xl border-r border-white/[0.06] p-7 flex flex-col fixed h-screen">
<div class="flex items-center gap-3.5"><img src="img/yllanna logo.png" class="w-[56px] h-[56px] rounded-2xl bg-white p-1 object-cover shadow-[0_0_30px_rgba(255,215,0,.3)]"><div><h2 class="font-black text-[17px]">YBVC</h2><p class="text-[11px] text-white/60">College of Computer</p></div></div>
<nav class="space-y-2 mt-12">
<a href="index.php" class="flex items-center gap-3.5 text-white/50 hover:bg-white/[0.06] px-4 py-3.5 rounded-2xl text-[13px]"><span class="w-7 h-7 bg-white/[0.06] rounded-xl flex items-center justify-center">📊</span> Dashboard</a>
<a href="students.php" class="flex items-center gap-3.5 bg-gradient-to-r from-[#2a5bda] to-[#3b6ef5] text-white px-4 py-3.5 rounded-2xl font-bold text-[13px] shadow-[0_8px_20px_rgba(42,91,218,.4)]"><span class="w-7 h-7 bg-white/20 rounded-xl flex items-center justify-center">👥</span> Students</a>
<a href="grades.php" class="flex items-center gap-3.5 text-white/50 hover:bg-white/[0.06] px-4 py-3.5 rounded-2xl text-[13px]"><span class="w-7 h-7 bg-white/[0.06] rounded-xl flex items-center justify-center">📝</span> Grades</a>
<a href="reports.php" class="flex items-center gap-3.5 text-white/50 hover:bg-white/[0.06] px-4 py-3.5 rounded-2xl text-[13px]"><span class="w-7 h-7 bg-white/[0.06] rounded-xl flex items-center justify-center">📄</span> Reports</a>
</nav>
<div class="mt-auto glass p-4 rounded-[20px] flex items-center gap-3 border-yellow-400/20"><img src="img/lip.jpg" onerror="this.src='img/yllanna logo.png'" class="w-11 h-11 rounded-2xl object-cover border-2 border-yellow-400/50"><div><p class="text-[13px] font-bold">Mohammad Salip</p><p class="text-[10px] text-white/40">Super Admin • <?php echo $count; ?> Students</p></div><div class="ml-auto w-2 h-2 bg-green-500 rounded-full animate-pulse"></div></div>
</aside>
<main class="flex-1 ml-[300px] p-10"><div class="flex justify-between items-center"><div><h1 class="text-[34px] font-black tracking-tight">Students</h1><p class="text-white/40 text-[13px] mt-1"><?php echo $count; ?> Active • Live from grading_system</p></div><button id="openAdd" class="bg-white text-black px-7 py-3.5 rounded-2xl font-bold text-[13px] shadow-xl hover:bg-yellow-400 transition">+ Add Student</button></div>
<div class="glass rounded-[28px] mt-8 p-8"><div class="flex gap-3 mb-6"><input id="search" placeholder="Search LRN, name, course..." class="glass px-6 py-3 rounded-2xl text-[13px] w-[380px] outline-none focus:border-blue-500"><select class="glass px-5 py-3 rounded-2xl text-[13px]"><option>All Courses</option><option>BSIT</option><option>BSCS</option></select></div>
<table class="w-full text-[13px]"><thead class="text-[10px] text-white/30 border-b border-white/[0.06]"><tr><th class="py-4 text-left">LRN</th><th class="text-left">NAME</th><th>COURSE</th><th>STATUS</th><th>ACTION</th></tr></thead><tbody class="divide-y divide-white/[0.04]">
<?php if($result){ while($row=$result->fetch_assoc()): 
$initial = strtoupper(substr($row['full_name'],0,1));
?>
<tr class="hover:bg-white/[0.02]"><td class="py-5 text-white/60"><?php echo $row['lrn']; ?></td>
<td class="font-semibold flex items-center gap-2"><div class="w-7 h-7 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-[9px] font-bold"><?php echo $initial; ?></div><?php echo htmlspecialchars($row['full_name']); ?></td>
<td><span class="glass px-3 py-1 rounded-full text-[11px]"><?php echo $row['course']; ?></span></td>
<td><span class="bg-green-500/15 text-green-400 px-3 py-1 rounded-full text-[10px] border border-green-500/20">● <?php echo $row['status']; ?></span></td>
<td class="flex gap-2"><button data-id="<?php echo $row['id']; ?>" data-lrn="<?php echo $row['lrn']; ?>" data-name="<?php echo htmlspecialchars($row['full_name']); ?>" data-course="<?php echo $row['course']; ?>" class="editBtn text-blue-400 px-2 py-1 rounded-lg hover:bg-blue-500/20">Edit</button><a href="students.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete si <?php echo $row['full_name']; ?>?')" class="text-red-400 px-2 py-1 rounded-lg hover:bg-red-500/20">Del</a></td></tr>
<?php endwhile; } ?>
</tbody></table></div></main>

<!-- MODAL -->
<div id="addModal" class="fixed inset-0 bg-black/80 backdrop-blur-md z-50 hidden flex items-center justify-center p-4">
<div class="glass bg-[#0a0d1f] p-8 rounded-[28px] w-full max-w-[450px] border border-white/10">
<h3 class="font-black text-[20px]" id="modalTitle">+ Add New Student</h3>
<form method="POST" class="mt-6 space-y-4">
<input type="hidden" name="id" id="idInput">
<input name="lrn" id="lrnInput" placeholder="LRN - 12 digits" required class="w-full glass px-4 py-3 rounded-2xl text-[13px] outline-none border border-white/10">
<input name="full_name" id="nameInput" placeholder="Full Name - Last, First M." required class="w-full glass px-4 py-3 rounded-2xl text-[13px] outline-none border border-white/10">
<select name="course" id="courseInput" class="w-full glass px-4 py-3 rounded-2xl text-[13px] border border-white/10">
<option>BSIT-2A</option><option>BSCS-3B</option><option>BSIT-1A</option><option>BSCS-1A</option>
</select>
<div class="flex gap-3 mt-8">
<button type="button" onclick="closeModal()" class="flex-1 glass py-3 rounded-2xl font-bold text-[13px]">Cancel</button>
<button name="save" class="flex-1 bg-white text-black py-3 rounded-2xl font-bold text-[13px]">Save to DB</button>
</div>
</form>
</div>
</div>

<script>
const modal=document.getElementById('addModal');
function closeModal(){modal.classList.add('hidden');}
document.getElementById('openAdd').addEventListener('click',()=>{
  document.getElementById('modalTitle').textContent='+ Add New Student';
  document.getElementById('idInput').value='';
  document.getElementById('lrnInput').value='';
  document.getElementById('nameInput').value='';
  modal.classList.remove('hidden');
});
document.querySelectorAll('.editBtn').forEach(b=>{
  b.addEventListener('click',()=>{
    document.getElementById('modalTitle').textContent='✏️ Edit Student';
    document.getElementById('idInput').value=b.dataset.id;
    document.getElementById('lrnInput').value=b.dataset.lrn;
    document.getElementById('nameInput').value=b.dataset.name;
    document.getElementById('courseInput').value=b.dataset.course;
    modal.classList.remove('hidden');
  });
});
modal.addEventListener('click',e=>{if(e.target===modal)closeModal();});
document.getElementById('search')?.addEventListener('input',e=>{
  let f=e.target.value.toLowerCase();
  document.querySelectorAll('tbody tr').forEach(r=>{r.style.display=r.textContent.toLowerCase().includes(f)?'':'none';});
});
</script>
<style>@media (max-width:768px){aside{display:none!important;}main{margin-left:0!important;padding:16px!important;}}</style>
</body></html>