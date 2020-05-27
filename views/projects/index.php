
<h1>Projects</h1>

<p>

<?php 
if($this->session->flashdata('project_inserted'))
{

	echo $this->session->flashdata('project_inserted');
}

?>
</p>

<p>

<?php if($this->session->flashdata('project_updated'))
{

	echo $this->session->flashdata('project_updated');
}

?>

</p>

<p>

<?php if($this->session->flashdata('project_deleted'))
{
   echo $this->session->flashdata('project_deleted');
}

?>

</p>

<a class="btn btn-primary pull-right" href="<?php echo base_url(); ?>projects/create">Create Project </a>


<script> type="text/javascript"

var wf_project_id="";
var del_project_id=[];

console.log("window=".concat(window));

window.addEventListener('focus', winfocus());

function winfocus()
{

// check insert task has been done (taskins_pid=project_id)
	// if(typeof taskins_pid === "undefined")
	// {
 //  		taskins_pid="";
	// }

		console.log("firing winfocus()");
	if (wf_project_id !== "" )
	{
		console.log("task insert was detected");
		console.log("project_id=".concat(wf_project_id));
		tab1=document.getElementById("taskstab1".concat(wf_project_id));
		tab2=document.getElementById("taskstab2".concat(wf_project_id));
		console.log(tab1);
		console.log(tab2);
		tab1.remove();
		tab2.remove();
		get_projectid(wf_project_id);

	}
}

	
function addElement(project_id,taskArr) 
{ 		
		wf_project_id="";
	 	create_tab1(project_id,taskArr);
	 	create_tab2(project_id,taskArr);
	 	cre_insbutn();

	function create_tab1(project_id,taskArr) 
	{
		
		var projtr = document.createElement('tr');   
		projtr.id="projtr".concat(project_id);
		projid=projtr.id;
		proid=document.getElementById(projid);
		var projtd = document.createElement('td');
		projtd.id="projtd".concat(project_id);   
		var projtab=document.getElementById('projtab');
		var taskstab1=document.createElement("TABLE");
		taskstab1id="taskstab1".concat(project_id);
		taskstab1.id=taskstab1id;
		taskstab1.classList="table table-dark";
		projrowidx="projrw".concat(project_id);

		function cre_header()
		{
			var taskstab1=document.getElementById(taskstab1id);
			var tab1thead = taskstab1.createTHead();   
			var row = tab1thead.insertRow(0);    
			var cell0 = row.insertCell(0);
			cell0.innerHTML = "";
			var cell1 = row.insertCell(1);
			cell1.innerHTML = "<b>Task ID</b>";
			var cell2 = row.insertCell(2);
			cell2.innerHTML = "<b>Description</b>";

		}

		function cre_chkbox(chkbxnm,val) 
		{
			c0d.type = "checkbox"; 
            c0d.name = chkbxnm; 
            c0d.value = val; 
            c0d.id = chkbxnm; 

		}


		var projrow=document.getElementById(projrowidx);
		projtr.appendChild(projtd);
		projtd.appendChild(taskstab1);
		projrow.after(projtr);
		cre_header();

		for(i=0;i<taskArr.length;i++)
		{
			cre_tab1rows(i,taskArr);

		}


		function cre_tab1rows(rownum,taskArr)
		{
		  	console.log("from cre_tab1rows...rownum=".concat(rownum));
		  	
			newrow=taskstab1.insertRow(rownum+1);

			c0=newrow.insertCell(0);
			c1=newrow.insertCell(1);
			c2=newrow.insertCell(2);
			c0d=document.createElement('input');
			cre_chkbox("chk".concat(taskArr[rownum].id),taskArr[rownum].id);
			c1d=document.createTextNode(taskArr[rownum].id);
			console.log("cre_tab1rows...id[".concat(rownum).concat("]=").concat(taskArr[rownum].id));
			c2d=document.createTextNode(taskArr[rownum].task_name);
			c0.appendChild(c0d);
			c1.appendChild(c1d);
			c2.appendChild(c2d);
				//	taskstab1.insertRow(newrow);
			
					
		}
	} 
// create tasktab2 in a new <td>

	function create_tab2(project_id,taskArr)
	{
		console.log('tasktab2');
		projtrid='projtr'.concat(project_id);
		console.log(projtrid);
		projtr=document.getElementById(projtrid);
		console.log(projtr);
		var second_projcol = document.createElement('td');
		second_projcol.id="proj2col";   
		var td2 = document.createElement('td');
		td2.id="tasktab2td";   
		var taskstab2=document.createElement("TABLE");
		taskstab2id="taskstab2".concat(project_id);
		taskstab2.id=taskstab2id;
		taskstab2.classList="table table-dark";
		var projrow=document.getElementById(projrowidx);
		task1tabloc=document.getElementById('taskstab1');

		
		function cre_delbutn()
		{
			var btn = document.createElement("BUTTON");
			btn.id="delbutton".concat(project_id);
    		var t = document.createTextNode("Delete");
    		console.log("calling.....cre_delbutn()".concat(btn));
    		//btn.setAttribute("style","color:blue;font-size:20px");
    		btn.classList="btn-primary";
    		btn.appendChild(t);
    		document.body.appendChild(btn);
    		btn.onclick=function(){deltasks()};
    		return(btn);
    	
			

    		function deltasks() 
    		{

    			console.log("firing deltasks");
    			var deltasklst=[];
    			arrele=0;
    			for(i=0;i<taskArr.length;i++)
    			{ 
    					chkbox="chk".concat(taskArr[i].id);
    					chkboxid=document.getElementById(chkbox);
    					console.log(chkboxid);
    					var chkd=chkboxid.checked;
    					var cbval=chkboxid.value;
    					if (chkboxid.checked==true)
    					{
    						deltasklst[arrele]=cbval;
    						arrele++;
    					}

    			}
    			tasks=deltasklst.join(',');
    			console.log("tasks to be delted=".concat(tasks));
    			del_dbtasks(tasks);
    			delarrsize=del_project_id.length;
    			if (delarrsize = 0)
    				{
    					del_project_id[0]=project_id;
    				}
    			else
    				{
    					del_project_id[delarrsize+1]=project_id;
    				}
    				console.log("Calling get_projectid from del_tasks()");
    			get_projectid(project_id);
    			
    			
    			function del_dbtasks(tasks)
				{ 
					$.post('tasks/del_loftasks', {elements:tasks},function(data,status,xhr)
						{   // success callback function
                			alert('status: ' + status + ', data: ' + data.responseData);
            			}
            		);
	    			//window.location.replace("http://localhost/ci/projects");

    			}
    		}
    	}

   		 // end-> insert new records

		function cre_headertab2()
		{
			var taskstab2=document.getElementById(taskstab2id);
			var tab2thead = taskstab2.createTHead();   
			var row = tab2thead.insertRow(0);    
			var cell0 = row.insertCell(0);
			var cell1 = row.insertCell(1);
			var cell2 = row.insertCell(2);
			cell0.innerHTML = "<b>Parent Task</b>";
			cell1.innerHTML = "<b>Level</b>";
			btn=cre_delbutn();
			cell1.after(btn);
		}

		console.log("rownum==0;creating table tasktab2.....");
		td2.appendChild(taskstab2);
		projtr.appendChild(td2);
		cre_headertab2();

		
		for(rownum=0;rownum<taskArr.length;rownum++)
		{
			console.log("calling cre_rows in tasktab2");
			cre_rows(rownum);
		}

		function cre_rows(rownum)
		{
			newrow=taskstab2.insertRow(rownum+1);
			c0=newrow.insertCell(0);
			c1=newrow.insertCell(1);
			console.log("taskarr[rownum].parent_Task_id=".concat(taskArr[rownum].task_id));
			c0d=document.createTextNode(taskArr[rownum].parent_task_id);
			c1d=document.createTextNode(taskArr[rownum].lvl);
			c0.appendChild(c0d);
			c1.appendChild(c1d);
			//taskstab2.insertRow(newrow);
		

			// if(rownum==0)
			// {
				
			// 	console.log("rownum==0;creating table tasktab2.....");
			// 	td2.appendChild(taskstab2);
			// 	projtr.appendChild(td2);
			// 	cre_headertab2();

			// }
		}

	}
	
		// begin-> insert new records

		function cre_insbutn()
		{
			var btn = document.createElement("BUTTON");
			var delbut=document.getElementById("delbutton".concat(project_id));
    		var t = document.createTextNode("Insert");
    		console.log("calling.....cre_insbutn()".concat(btn));
    		//btn.setAttribute("style","color:blue;font-size:20px");
    		btn.classList="btn-primary";
    		btn.appendChild(t);
    		document.body.appendChild(btn);
    		delbut.after(btn);
    		console.log("project_id".concat(project_id));
    		//btn.onclick=function(){instasks()};
    		btn.onclick=function(){popupwindow()};

    		return(btn);
		    	
    		function popupwindow()
    		{

    		var url='http://localhost/ci/tasks/js_add_task/'.concat(project_id);
    		var windowName="New Tasks"
    		windowObjectReference = window.open(url, windowName,
           "width=500,height=500,left=600,top=100,resizable,scrollbars,status");

    		wf_project_id=project_id;
    		console.log("from insert_func()..wf_project_id=".concat(wf_project_id));

    		}

		}

}
function inserttasksonly(project_id)
    		{
    			let params = `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=yes,width=500,height=500,left=600,top=100`;

				var url='http://localhost/ci/tasks/js_add_task/'.concat(project_id);
				console.log("project_id".concat(project_id));
				window.open(url, 'test', params);
			}


</script>


<script> type="text/javascript" 

		function get_projectid(project_id)
		{ 
			console.log("get_projectid is fired...")
			var xhttp = new XMLHttpRequest();
  			xhttp.onreadystatechange = function() 
  			{
    			if (this.readyState == 4 && this.status == 200)
    			{
    				
    				if (this.responseText.length > 3)
    				{
    					var tasksArr = JSON.parse(this.responseText); 
    					console.log("responseText=".concat(this.responseText));
      				  
      				  projicon.className="glyphicon glyphicon-collapse-down";
      				  insert_new_tasks_only=false;
      				  addElement(project_id,tasksArr);
      				 }
      				 else
      				 {
      				 	inserttasksonly(project_id);
      				 }

      			}
      		}			
      		
      		
    			manage_tasktabs();
            
        
        function manage_tasktabs() 
        {
         	projicon=document.getElementById("projicon".concat(project_id));
         	piconclass=projicon.className;
         	console.log(piconclass);
         	taskstab1=document.getElementById('taskstab1'.concat(project_id));
  			taskstab2=document.getElementById('taskstab2'.concat(project_id));
  			
      		if (piconclass == "glyphicon glyphicon-expand")
      		{
      				console.log("icon=glyphicon-expand");
      				if (taskstab1 == null || wf_project_id != "" || del_project_id.includes(project_id))			
      				{
      					console.log('tasktab1 is not there yet or need refreshing');
  						xhttp.open("GET", "http://localhost/ci/tasks/list_tasks/".concat(project_id), true);
  						console.log('this is after xhttp.open statement');
  						xhttp.send();
  						console.log('this is after xhttp.send');


  					}
  					else
  					{

  						console.log("tasktables already exist");
  						taskstab1.style.display="table";
  						taskstab2.style.display="table";
  						projicon.className="glyphicon glyphicon-collapse-down";
  					}
  			}
  			else
  			{

  				console.log("switch off task tables");
  				console.log(taskstab1);
  				taskstab1.style.display="none";
  				taskstab2.style.display="none";
  				projicon.className="glyphicon glyphicon-expand";
  			}
			
		}
	}
		
</script>
		


<table id="projtab" class="table  table-dark">
	<thead>
	<tr>
		<th>
		Project Name
		</th>
		<th>
		Description
		</th>
	</tr>
	</thead>
	<tbody>
		
		<?php foreach($projects as $project): ?>
		
		<?php echo '<tr id="projrw'.$project->id.'">' ?>
		<?php echo '<td><span  id="projicon'. $project->id .'"class="glyphicon glyphicon-expand"></span>'.'<a id="project_id" href='. base_url() ."projects/display/". $project->id .">"." ".$project->project_name . "</a></td>"?>
		<?php echo "<td>".$project->project_body; "</td>"?>


		<td><a class="btn btn-danger" href='<?php echo base_url() ."projects/del_proj/". $project->id ?>'><span class="glyphicon glyphicon-remove"></span></a></td>

		

		</tr>


		<script> type="text/javascript" 
	
		document.getElementById('projicon<?php echo $project->id ?>').addEventListener('click',function(){
			get_projectid(<?php echo $project->id ?>) ;
	
		}
		);
	
		</script>
		
	<?php endforeach ?>
		
		

	</tbody>

</table>



<?php 

   	
?>			
