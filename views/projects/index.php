
<h1>Projects</h1>

<!-- <a class="btn btn-primary pull-right" href="<?php echo base_url(); ?>projects/create">Create Project </a>
-->
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
      				  tasksOrdArr=get_tasksordered(tasksArr);
      				  display_tasks(tasksOrdArr);
      				  draw_vline();
      				  console.log("The calling of functions ends here...!!");

      				  }
      				  
      				}
      		}
      				
      	function display_tasks(tasksOrdArr)
      	{
   			projrw=document.getElementById('projrw'.concat(project_id));
   			outdiv=document.createElement('div');
   			outdivid="outdiv"+project_id;
   			console.log("outdivid="+outdivid);
   			outdiv.id=outdivid;
   			
   			//outdiv.classList.add("col-xs-9","outdiv");
      		
      		var i=0;
      			   	     	
      		for(i=0;i<tasksOrdArr.length;i++)
      		{
      			
      			tdiv1=document.createElement('div');
      			//tdiv1.style="margin-bottom:0px;margin-top:0px;padding-top: 0px;padding-bottom: 0px;border-left: 2px solid #897F7F; #border-style:solid;"
      			var tskid=tasksOrdArr[i].id;
      			tdiv1_id="t"+tskid+"l"+tasksOrdArr[i].lvl;
      			tdiv1.id=tdiv1_id;
      	
      		
      			tskhr=document.createElement('hr');
      			//tskhr.style="margin-top:10px;margin-bottom:10px;padding-top: 0px;padding-bottom: 0px;border: 0.01px solid #5CB3FF";
      			tskhr.id="hr"+tskid;
      			tskhr.className="tskhr";

      			console.log("tskid="+tskid);
      			
      			spanele=document.createElement("span");
      			ikid="ic"+tskid+'l'+tasksOrdArr[i].lvl;
      			spanele.id=ikid;

      			vprcind=varrParChld[i];
      			if (vprcind=="C")
      			{
      				 spanele.className='glyphicon glyphicon-minus-sign disabled';
      				 console.log("vprcind & taskid"+vprcind+" "+tskid);
      			}
      			else
      			{
      			   spanele.className='glyphicon glyphicon-plus-sign';
      			}

				   	pgrp='pt'+tasksOrdArr[i].parent_task_id;

      				tdivc2=document.createElement('div');
      				tdivc2.className="col-xs-1";
      				task_id=document.createTextNode(tasksOrdArr[i].id);

      				tdivc3=document.createElement('div');
      				tdivc3.className="col-xs-12";

      				if (tasksOrdArr[i].lvl == 1)
      				{
      					tdivc3.style="#border-left: 10px solid #5CB3FF;background-color:#897F7F;color:white;";
      					rt=tasksOrdArr[i].id;
      				}
      				else
      				{
      					tdivc3.style="border-left: 10px solid #5CB3FF;";
      					tdiv1.classList.add('hiditm');
      				}

      					prtgrp_cl='pt'+tasksOrdArr[i].parent_task_id;
      					tdiv1.classList.add(prtgrp_cl);
      					grp_cl=rt+'l'+tasksOrdArr[i].lvl;
      					tdiv1.classList.add(grp_cl);
      					task_name=document.createTextNode(tasksOrdArr[i].id+" "+tasksOrdArr[i].task_name+' '+tasksOrdArr[i].lvl);

      					tdivc3.appendChild(spanele);
      					//tdivc1.appendChild(task_lvl);
      					tdivc2.appendChild(task_id);
      					tdivc3.appendChild(task_name);
      			
      					//tdiv1.appendChild(tdivc1);
      					//tdiv1.appendChild(tdivc2);
      					//hrdiv.appendChild(tskhr);

      					tdiv1.appendChild(tdivc3);
      					//tdiv1.appendChild(fstvldiv);
      					outdiv.appendChild(tdiv1);
      					tdiv1.appendChild(tskhr);
      			
      					//tdiv1.after(tskhr);
      			
      					//outdiv.appendChild(hrdiv);
 						projrw.appendChild(outdiv);

 						outdivele=document.getElementById(outdivid);
   						console.log("outdivele="+outdivele);
   						outdivele.classList.add("col-xs-9","outdiv");
      		


 						tdiv1id=document.getElementById(tdiv1_id);
      					console.log("tdiv1id="+tdiv1id);
      					root=document.getElementById(tdiv1_id);
      					lvlclass="lvl1";
      					tdiv1id.classList.add("row");
      			

	      			(function(idx) 
	      			{
	      				console.log("tasksOrdArr[i].lvl="+tasksOrdArr[idx].lvl);
	      				
	      				vlvl=root.style.getPropertyValue('--lvl');
	      				vbg=root.style.getPropertyValue('--bg');
	      				console.log("current value of --lvl= & vbg="+vlvl+vbg);
	      				vlvl2=getComputedStyle(document.documentElement).getPropertyValue('--lvl');
	      				console.log("current value of --lvl2="+vlvl2);
	      					vlvl=1;
	      				root.style.setProperty('--lvl',(tasksOrdArr[idx].lvl*vlvl)+'px' );

	      				root.style.setProperty('--bg','red' );
	      				vbg=root.style.getPropertyValue('--bg');
	      				//console.log("current value of --lvl= & vbg="+vlvl+vbg);
	      				
	      				//console.log((tasksOrdArr[idx].lvl*vlvl)+'px' );
	      				
	      				tdiv1id.classList.add('lvl1');
	      				vlvl2=root.style.getPropertyValue('--lvl');
	      				//vlvl2=getComputedStyle(document.documentElement).getPropertyValue('--lvl');
	      				console.log("after change property....the current value of --lvl="+vlvl2);
	      				
	      			} )(i);

      		
      				var iknele=document.getElementById(ikid);
      			
      			
      			// Note: Enclosure function is used, as the current value of the // parameter in the loop could not be passed

		      			iknele.addEventListener('click', function(vprcind,rt)
		      			{
		      				return function()
		      				{
		      					thisid=this.id;
		      					console.log("icon id="+thisid);
		      					icn=document.getElementById(thisid);
		      					thistaskid=thisid.substring(2,rt.length+2);
		      					console.log("this task id in click eve++rt.length="+thistaskid+rt.length);
		      					//alert("this element parent id is"+thisid);

		      					function find_child_tasks(pid)
		      					{
		      						var i=0;
		      						var chi=[];
		      						chiidx=0;
		      						for (i=0;i<tasksOrdArr.length;i++)
		      						{
		      							if (pid==tasksOrdArr[i].parent_task_id)
		      							{
		      								chi[chiidx]=tasksOrdArr[i].id;
		      								chiidx=chiidx+1;
		      							}
		      						}

		      						return chi;

		      					}

		      					vlevel=thisid.substring(rt.length+3);

		      					if (vprcind=="P")
		      					{
		      						console.log("the current classname of icon "+icn.className);

		      						if (icn.className=='glyphicon glyphicon-minus-sign')
		      						{
		      							console.log("BEGINNING OF COLLAPSE NODES");
		      							icn.className='glyphicon glyphicon-plus-sign';
		      							var tsks=[];

		      							//Generate task_id

		      							tsks[0]='t'+thisid.substring(2);
		      							console.log("thisid=+tsks[0]="+thisid+' '+tsks[0]);
		      							itm=[1];

		      						while (itm.length > 0)
		      						{
		      							var j=1;
		      							for (idx=0;idx<tsks.length;idx++)
		      							{
		      								console.log("outer for loop;task tracked="+tsks[idx]);

		      								// Find children tasks of current task

		      								tskid=tsks[idx].substring(1,(rt.length+1));
		      								//console.log("tskid="+tskid);
		      								vchldtsk='pt'+tskid;    								
		      								itm=document.getElementsByClassName(vchldtsk);
		      								
		      								for (i=0;i<itm.length;i++)
		      								{

		      									console.log("inner for loop elements tracked..itm[i].id="+itm[i].id);
		     									

		      									//check the item collapsed has any children and change the icon to  "+"

		      									
		      									icnid='ic'+itm[i].id.substring(1);
		      									icn=document.getElementById(icnid);
		      									tskid=itm[i].id.substring(1,(rt.length+1));
		      								
		      									console.log("icnid+classname="+icnid+icn.className);

												if ( icn.className=='glyphicon glyphicon-plus-sign' ||icn.className=='glyphicon glyphicon-minus-sign disabled')
		      									{
		      										console.log("this is minus disabled or with plus sign"+itm[i].id);
		      										itm[i].classList.toggle('hiditm');
		      									}
		      									else if  (icn.className=='glyphicon glyphicon-minus-sign')
		      									{
		      										itm[i].classList.toggle('hiditm');
		      										icn.className='glyphicon glyphicon-plus-sign';
		      										console.log("toggling node="+itm[i].id);
		      										tsks[j]=itm[i].id;
		      										j=j+1;
		      									}
		      								}
		      						
										}
									if (j==1 || j==idx)
											break;
									
									
									}

									}
				      						else
				      						{
				      							icn.className='glyphicon glyphicon-minus-sign';
				      							console.log("EXPANDING ITEM NODES.....!!");
				      							nxtlvlitm='pt'+thistaskid;
				      							console.log('nxtlvlitm='+nxtlvlitm);

				      							itm=document.getElementsByClassName(nxtlvlitm);
				     							console.log("itm.length="+itm.length);
				     							for (i=0;i<itm.length;i++)
				     							{
				     								
				     								nxtlvlitm='pt'+itm[i].id;

				     								//check if it has any children, reset the icon to plus if so!

				     								if (document.getElementsByClassName(nxtlvlitm).length > 0)
				     								{
				     									console.log("this has children="+nxtlvlitm);
				     									icnid='ic'+nxtlvlitm.substring(1);
				     									icn=document.getElementById(icnid);
				     									icn.className='glyphicon glyphicon-plus-sign';
				     								}
				     								itm[i].classList.toggle('hiditm');

				     							}
				     						}
				      			}
								}
				    			}(vprcind,rt));
				    		}

      		}
      	
      
	 function draw_vline()
	 {
			var i=0;
      		var dnme;
      		var tmpdn;
			var fstdn;
							   	     	
			var prevlvl=0;
			var vrtlvl=0;
			projdiv='outdiv'+tasksOrdArr[i].project_id;
			projdivele=document.getElementById(projdiv);

      		for(i=0;i<tasksOrdArr.length;i++)
      		{
      			vprcind=varrParChld[i];

      			console.log("BEGINNING OF VERTICAL LINE FOR LOOP");
      			console.log("i=+taskid="+i+" "+tasksOrdArr[i].id);


      			if (tasksOrdArr[i].lvl > 1 && (tasksOrdArr[i].id == 162 ||tasksOrdArr[i].id == 164 ||tasksOrdArr[i].id == 166 ))      				 
      			{
      				tskdiv="t"+tasksOrdArr[i].id+"l"+tasksOrdArr[i].lvl;
      				console.log("the div to be appended"+tskdiv);
      				tskdivele=document.getElementById(tskdiv);
      				var pgrp='pt'+tasksOrdArr[i].parent_task_id;

      				var itm=document.getElementsByClassName(pgrp);

				  	console.log("PARENT GROUP COUNT="+pgrp+' '+itm.length);

				   	if (itm.length > 1)
				   	{
				   		vldivout='divout'+pgrp;
				   	   	vldivoutele=document.createElement('div');
				   	   	vldivoutele.id=vldivout;
				   	   	console.log("div id created vloutdivid="+vldivout);
				   	   	tskdivele.parentNode.insertBefore(vldivoutele,tskdivele.nextSibling);
				   	   	//projdivele.insertBefore(vldivoutele,tskdivele);



				   	   	vldivin='divin'+pgrp;
				   	   	vldivinele=document.createElement('div');
				   	   	vldivinele.id=vldivin;
				   	   	
				   	   	vldivinele.classList.add('vldivin');

				   	   	vldivoutele.appendChild(vldivinele);

				   	   	
				   	   	// find the root element's level which will be used in the calculation below to set padding-left for child elemnts

				   	   	prevlvl=vrtlvl;


				   	   	root=document.getElementById(vldivout);
				   	   	vrtlvl=tasksOrdArr[i].lvl;
				   	   	vrtlvl1= ( vrtlvl - prevlvl )  * 18;
				   	   	
				   	   	if (vrtlvl1 == 0)
				   	   		vrtlvl1=18;

				   	   	vrtlvl1=vrtlvl1+'px';
				   	   	console.log("the calculated value to be passed 2 --rtlvl="+vrtlvl1);
				   	   	root.style.setProperty('--rtlvl', vrtlvl1 );
				   	   	vrtlvl1=root.style.getPropertyValue('--rtlvl');
				   	   	console.log("rootlevel set is,"+vrtlvl1);

				   	   	vldivoutele.classList.add('vldivout');
	      				
				   		var vrange=[];
				   		var vrngitm=[];

				   		var fstitm=itm[0].id;
				   		console.log("fstitm="+fstitm);

				   		var lstitm=itm[itm.length-1].id;

				   		console.log('lastitm='+lstitm);
				   		
				   		fstitmele=document.getElementById(fstitm);
				   		lstitmele=document.getElementById(lstitm);
				   		
				   		var rofitms=get_itms_inrange();

				   		var i2=0;
				   		var chldid;

				   		for (i2=0;i2<rofitms.length;i2++)
				   		{
				   			chldid='t'+rofitms[i2].id+'l'+rofitms[i2].lvl;
				   				
				   			console.log("rofitms[i2]="+chldid);
				   			chldele=document.getElementById(chldid);
				   			console.log("parent of before change "+chldid+" "+chldele.parentNode.id);
				   			//chldele.parentNode.removeChild(chldele);
				   			vldivinele.appendChild(chldele);


				   			root=document.getElementById(chldid);

				   			// reset padding-left to get the vertical line


				   			root.style.setProperty('--lvl2',(rofitms[i2].lvl)+'px' );
				   			vrtlvlnum= ( ( (vrtlvl - prevlvl)  * -18 ) + (rofitms[i2].lvl - vrtlvl) * 18 ) ;
				   			vrtlvlnum=vrtlvlnum+'px';
				   			console.log("vrtlvlnum="+vrtlvlnum);
				   			root.style.setProperty('--rtlvlnum',vrtlvlnum);
	      					vlvl2=root.style.getPropertyValue('--lvl2');
	      					console.log("frm vldraw the current value of --lvl2 & lvl="+vlvl2+' '+rofitms[i2].lvl);
	      					chldele.classList.remove('lvl1');
	      					chldele.classList.add('tskitm');  
	      					//chldele.classList.add('v2');  

				   			console.log("successfully appendChild is done on "+chldid);
				   			console.log("parent of after change "+chldid+" "+chldele.parentNode.id);
				   			
				   		}
				   		//console.log("appendchild vldivele to vldivele2");
				   		//console.log("the parent of vldivele="+vldivele.parentNode);

				   		//vldivele2.appendChild(vldivele);

				   		function find_pos(itm)
				   		{

				   			var curritm;
				   			var i=0;
				   			for (i=0;i<=tasksOrdArr.length;i++)
				   			{	
				   				curritm='t'+tasksOrdArr[i].id+'l'+tasksOrdArr[i].lvl;
				   				if (curritm == itm)
				   				{
				   					pos=i;
				   					break;
				   				}
				   			}
				   			return pos;
				   		}


				   		function get_itms_inrange()
				   		{
				   			var i=0;
				   			var j=0;
				   			var startpos=0;
				   			var resultarr=[];
				   			i=find_pos(fstitm);	
				   			
				   			// find position of the last item
				   			// add +1 to include the last element too in resultarr

				   			l=find_pos(lstitm)+1;
				   			console.log("startpos(i)=lastpos(l)"+i+' '+l);

				   			curritm='t'+tasksOrdArr[i].id+'l'+tasksOrdArr[i].lvl;
				   			lstitm='t'+tasksOrdArr[l].id+'l'+tasksOrdArr[l].lvl;
				   			console.log("curritm="+curritm);
				   			while (curritm !== lstitm && i <tasksOrdArr.length && tasksOrdArr[i].lvl>1)
				   			{
				   				console.log("inside while curritm+startpos+lstitm"+curritm+' '+i+" "+lstitm);
				   				resultarr[j]=tasksOrdArr[i];
				   				i=i+1;
				   				j=j+1;
				   				curritm='t'+tasksOrdArr[i].id+'l'+tasksOrdArr[i].lvl;
				   			}
				   					console.log("get_itms_inrange ends here...");
				   					return resultarr;

				   		}	
				   	}
				  }


			}
				   	   
      			
    }

	


   
   	manage_tasktabs();
        function manage_tasktabs() 
        {
         	projicon=document.getElementById("projicon".concat(project_id));
         	piconclass=projicon.className;
         	tskdiv=document.getElementById("outdiv"+project_id);
         	console.log(piconclass);
         	
      		if (piconclass == "glyphicon glyphicon-expand")
      		{
      			
      				if ( tskdiv == null )	
      				{
      					xhttp.open("GET", "http://localhost/ci/tasks/list_tasks/".concat(project_id), true);
  						console.log('this is after xhttp.open statement');
  						xhttp.send();
  						console.log('this is after xhttp.send');
  					}
  					else
  					{
  						console.log("The task div is already present; set display to block");
  						tskdiv.style.display="inline";
  						projicon.className="glyphicon glyphicon-collapse-down";
  					}


  			}
  			else
  			{
  				//projicon.className="glyphicon glyphicon-collapse-down";
  				document.getElementById("outdiv"+project_id).style.display="none";
  				projicon.className="glyphicon glyphicon-expand";

  				
  			}
			
		}

	function get_tasksordered(tasks)
	{
// find the location of the corresponding project_id in the window

		projrw="projrw".concat(project_id);
		projrwid=document.getElementById(projrw);
		var varrpartrk=[];
		
// insert task records under project_id
		
		function find_child_task(id,ocur=1) 
		{
			var oc=0;
			var i=0;
			for (i=0;i<tasks.length;i++)
			{
				//console.log("(1)find_child_tasks id=pid=oc=".concat(tasks[i].id).concat(".").concat(tasks[i].parent_task_id).concat(".").concat("+").concat(oc));
			

				if ( tasks[i].parent_task_id==id )
				{
					// console.log("(2)find_child_tasks id=>oc=".concat(id).concat("+").concat(oc));
			
					oc=oc+1;
					if (oc == ocur)
						break;
				}

			}
			
			if (i<tasks.length)
			{
				// console.log("find_child_task retval=".concat(tasks[i].id));
				return(tasks[i].id);
			}
			else
				return null;
		}

		function find_parent_task(id) 
		{
			var vparent_task_id=0;
			for (i=0;i<tasks.length;i++)
			{
				if (tasks[i].id==id)
				{
					vparent_task_id=tasks[i].parent_task_id;
					//console.log("find_parent_task returns".concat(vparent_task_id));
					break;

				}

			}
			return vparent_task_id;
		}

		function find_root_tasks()
		{
			var i=0;
			var j=0;
			var roottaskarr=[];
			for (i=0;i<tasks.length;i++)
			{
				if (tasks[i].parent_task_id==0)
				{
					//console.log("find_root_Task ".concat(tasks[i].id));
					roottaskarr[j]=tasks[i].id;
					//console.log("find_root_Task= ".concat(roottaskarr[j]));
					j=j+1;
				}
			}
			return (roottaskarr);

		}


		function find_child_count(id)
		{
			var i=0;
			cnt=0;
			for (i=0;i<tasks.length;i++)
			{
				if (tasks[i].parent_task_id==id)
					cnt=cnt+1;	
			}
			return(cnt);
		}

		function find_task_idx(id,vtaskarr)
		{
			//console.log("called find_task_idx with ".concat(id));
			found=false;
			var i=0;
			for(i=0;i<vtaskarr.length;i++)
			{
				//console.log("find_task_idx index=".concat(i).concat("=>").concat(varrpartrk[i].id));

				if (vtaskarr[i].id == id)
				{
					found=true;
					//console.log("(1)find_task_idx=".concat(i));
					break;
				}
			}
			//console.log("(2)find_task_idx index=".concat(i));
			if (found)
			   return(i);
			else
				return(0);

		}

		 var taskarrordered=[];
		 var vtaskarroderedcnt=0;
		 var i=0;
		 
		 var vroottaskarr=[];
		 vroottaskarr=find_root_tasks();
		 varrParChld=[];
		 for (i=0;i<vroottaskarr.length;i++)
		 {
		 	var voccur=1;
		 	console.log("Starting from the root task");
		 	var vcurrtask=vroottaskarr[i];
		 	var vcurrlvl=1;
		 	var varrcnt=0;
		 	
		 	var vchldcnt=find_child_count(vcurrtask);
		 	var vparent_task=vcurrtask;

			var vtempind=0;
		 	while ( vparent_task != 0 )
		 	{
		 		// console.log("vparent_task=".concat(vparent_task));
		 			if (vcurrtask == null )
		 			{

						console.log("vcurrtask is null"+vcurrtask);
						vcurrtask=vintmedtask;
						//console.log("vintmedtask".concat(vintmedtask));
					
				
						// if ( vchldcnt == 0 ) 
					
						vparent_task=find_parent_task(vcurrtask);
						vcurrtask=vparent_task;
					
						//	console.log("vcurrtask is null...set it to=".concat(vcurrtask));
						console.log("calling find_task_idx with".concat(vcurrtask));
						taskidx=find_task_idx(vcurrtask,varrpartrk);
						voccur=varrpartrk[taskidx].voccur;
						voccur=voccur+1;
						varrpartrk[taskidx].voccur=voccur;
						//	console.log("vcurrtask++vchldcnt==0++ voccur=".concat(vcurrtask).concat("++").concat(voccur));
					}
					else
					{
						taskarrordered[vtaskarroderedcnt]=tasks[find_task_idx(vcurrtask,tasks)];
						if (find_child_count(vcurrtask)==0)
							varrParChld[vtaskarroderedcnt]="C";
						else
									varrParChld[vtaskarroderedcnt]="P";

						console.log("task=> ".concat(vcurrtask));
						voccur=1;
						str='{"id":'.concat(vcurrtask).concat(',"voccur":').concat(voccur).concat('}');
						console.log(str);
						tmpvar=JSON.parse(str);
						varrpartrk[varrcnt]=tmpvar;
						//console.log("array length of varrpartrk".concat(varrpartrk.length));
						//vchldcnt=find_child_count(vcurrtask);
		 				varrcnt=varrcnt+1;
		 				vtaskarroderedcnt=vtaskarroderedcnt+1;
					}
				 	
				 	
				
				// store vcurrtask and voccur in an array to refer later
				
				vintmedtask=vcurrtask;

				console.log("find_child_count="+vcurrtask+"="+find_child_count(vcurrtask));

				vcurrtask=find_child_task(vcurrtask,voccur);

				//console.log("check return val of currtask".concat(vcurrtask));

				//vtempind=vtempind+1;
			}
		  }
		
		return taskarrordered;
	}
	
}

		
		
</script>
		
		<?php foreach($projects as $project): ?>
		
		<?php echo "<div class='row' id='projrw".$project->id."'>" ?>	
		<?php echo "<div id='divhglt".$project->id."' class='col-xs-10'>" ?> 
		<?php echo "<div class='col-xs-2'>" ?>
		<?php echo '<span  id="projicon'. $project->id .'" class="glyphicon glyphicon-expand"></span>'.'<a id="ahglt'.$project->id.'" href='. base_url() ."projects/display/". $project->id .">"." ".$project->project_name . "</a>" ?>

		<?php echo "</div>" ?>			
	
		<?php echo "<div class='col-xs-7'>" ?>
		<?php echo $project->project_body; ?>
		<?php echo "</div>" ?>			
		<?php echo "</div>" ?>
		
	
		<?php echo "<div class='col-xs-1, pl-0'>" ?>
	
		<a class="btn btn-danger" href='<?php echo base_url() ."projects/del_proj/". $project->id ?>'><span class="glyphicon glyphicon-remove"></span></a>

		<script> type="text/javascript" 
	
		document.getElementById('projicon<?php echo $project->id ?>').addEventListener('click',function(){
			var divele=document.getElementById('divhglt<?php echo $project->id ?>' );
			var aele=document.getElementById('ahglt<?php echo $project->id ?>' );
			
			divele.classList.toggle("txthlt");
			aele.classList.toggle("txthlt");
			get_projectid(<?php echo $project->id ?>) ;

	
		}
		);
	
		</script>
		<?php echo "</div>" ?>			
		
		<?php echo "</div>" ?>			
		
	<?php endforeach ?>
		
		<?php echo "</div>" ?>	
		<?php echo "</p>" ?>					
		<?php echo "</p>" ?>				
	
<?php 

   	
?>			
