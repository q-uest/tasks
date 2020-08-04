
<!-- <h1>Projects</h1> 
-->

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

              // adding a new column to indicate the task is parent or child 

      				  tasksArr.forEach(function(e){
                if (typeof e === "object" ){
                  e["has_child"] = "N"
                }
                });

              //
      				  projicon.className="glyphicon glyphicon-collapse-down";
      				  //tasksOrdArr=get_tasksordered(tasksArr);
      				 // display_tasks(tasksOrdArr);
                display_tasks(tasksArr);
      				  //draw_vline();
      				  console.log("The calling of functions ends here...!!");

      				  }
      				  
      				}
      		}

    function find_root_tasks(tasksOrdArr)
    {
      var i=0;
      var j=0;
      var roottaskarr=[];
      var tasks=tasksOrdArr;
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




      				
    	function display_tasks(tasksArr)
    	{
 		   	projrw=document.getElementById('projrw'.concat(project_id));
 			  var tskid=[];
        
        var i=0;
        var k=0;
        var chldcnt=0;
     
        pt0tsk=find_root_tasks(tasksArr);

        for (i=0;i<pt0tsk.length;i++)
        {
          tskpos=find_task_idx(pt0tsk[i],tasksArr);

          tskid[0]=tskpos;
          console.log("tskpos=tskid[i]=tasksArr[tskid[i]]="+tskpos+' '+tskid[0]+' '+tasksArr[tskpos].group_id);
          tskgid=tasksArr[tskpos].group_id;
          console.log("ROOT TASKS==="+tasksArr[tskid[0]].id);
          chldtsk=pub_find_child_tasks(tasksArr,tskid,tskgid);
          console.log("ROOT TASKS chldtsk.length="+chldtsk.length);
          console.log("chldtsk.length=tskid[i]="+chldtsk.length+' '+tskid[i]);


          while (chldtsk.length > 0  )
          {
            chldcnt=0;
            var j=0;
            for (j=0;j<chldtsk.length;j++)
            {
              console.log("DISPLAY TASKS inner="+tasksArr[chldtsk[j]].id,' '+tasksArr[chldtsk[j]].task_name+' '+tasksArr[chldtsk[j]].parent_task_id+' '+tasksArr[chldtsk[j]].has_child);

              //tskid[chldcnt]=tasksArr[chldtsk[j]].id;
              tskid[chldcnt]=chldtsk[j];
              chldcnt=chldcnt+1;

            }
            console.log("CURRENT BATCH OF TASKS...");

            for (idx=0;idx<tskid.length;idx++)
            {
                      console.log(tasksArr[tskid[idx]]);
            }
            console.log("NEXT BATCH OF TASKS.....");
            console.log("==========================");
            chldtsk=pub_find_child_tasks(tasksArr,tskid,tskgid);
            tskid=chldtsk;
            console.log("after new iteration of chldtsk...chldtsk.length="+chldtsk.length);
             
          }
          
        
          console.log("EXITING WHILE LOOP...chldtsk.length="+chldtsk.length);
    
        }
        var indiv2id=null;
        var elecnt=0;
        var prevgrpid=null;
        var grpidarr=[];
        
        var grpcnt=0;
        var grpid=tasksArr[0].group_id;

        var prevdivid;
        var prevdiv;
        var currlvl;
        var prevomid=0;
        var omdivid=0;
        var outdivid;
        var rowcnt=1;

        var partsk=[];
        var pcnt=0;


        for (i=0;i<tasksArr.length;i++)
        {
          console.log(tasksArr[i].id,tasksArr[i].task_name,tasksArr[i].parent_task_id,tasksArr[i].lvl,tasksArr[i].has_child);

          taskid=tasksArr[i].id;
          grpidarr[grpcnt]=grpid;
          grpid=tasksArr[i].group_id;
          
          prevlvl=currlvl;
          currlvl=tasksArr[i].lvl;
          
          // Add unique parent tasks to partsk array

          ptsk=tasksArr[i].parent_task_id;

          ptskexi='N';
          
          for (p=0;p<partsk.length;p++)
          {
            if (ptsk == partsk[p][1])
            {
              ptskexi='Y';
              break;
            }
          }
          
          if (ptskexi=='N')
          {
            partsk[partsk.length]=[grpid,ptsk,currlvl];
            
          }
          // outermost div enclosing encdiv

          

          prevomid=omdivid;
          omdivid='om'+taskid;


          if (prevomid !== omdivid)
          {
            omdiv=document.createElement('div');          
            omdiv.id=omdivid;
          }


          //


          // enclosing content div for providing scrollbar functionality


          

          encdiv=document.createElement('div');
          encdivid='enc'+taskid;
          encdiv.id=encdivid;

          //

          // div for each task row

          tdiv=document.createElement('div');
          tdivid='tdiv'+taskid;
          tdiv.id=tdivid;

          //

          // horizontal line

          tskhr=document.createElement('hr');
          tskhrid="hr"+taskid;
          tskhr.id=tskhrid;
          tskhr.className="tskhr";



          // icon for tasks

          spanele=document.createElement("span");
          ikid="ic"+tskid;
          spanele.id=ikid;

          //

          // assign icon based on whether task having children

          if (tasksArr[i].has_child=="N")
             spanele.className='glyphicon glyphicon-minus-sign disabled';
          else
              spanele.className='glyphicon glyphicon-plus-sign';
          
          //    


          // content div 

          cntdiv=document.createElement('div');
          cntdiv.className='col-xs-12';


          // div for holding task records

          divc1=document.createElement('div');
          divc1.className="col-xs-12";

          //

          tname=document.createTextNode("  "+tasksArr[i].task_name+'('+tasksArr[i].id+')'+' '+tasksArr[i].lvl);
          tassignee=document.createTextNode(tasksArr[i].assignee);
          tduedate=document.createTextNode(tasksArr[i].due_date);

          // vldiv....to draw vertical line

          
          //prevldiv=vldivid;
          //vldivid='pt'+taskArr[i].parent_task_id;
          
          // if task level == 1 (root task), assign a different style from the ones having level > 1
          
          ptsk=tasksArr[i].parent_task_id;          
          
          if (grpidarr[grpcnt] !== grpid)  
          {
            grpcnt=grpcnt+1;
            grpidarr[grpcnt]=grpid;
          }
          

          prevdivid=outdivid;
          outdivid='outdiv_pt'+ptsk+'_'+grpid;
          


          outrowid='outrow'+taskid;
          outrow=document.createElement('div');
          outrow.id=outrowid;

          if (currlvl==1 && tasksArr[i].has_child=='Y')
          {
              
            outdiv=document.createElement('div');  
            outdiv.id=outdivid;
          
            // set style
            

            divc1.style="border-left: 10px solid #2E4053;border-right: 10px solid #2E4053;#background-color:#897F7F ;color:#2E4053" ;

            
            rtdiv=document.createElement('div');
            rtdiv.appendChild(spanele);
            rtdiv.appendChild(tname);
            cntdiv.appendChild(rtdiv);

          }
          else if  (currlvl>1)
          {

            
            rowcnt=rowcnt+1;
            
            outdiv=document.getElementById(outdivid);
          
            if (outdiv == null)
            { 
              console.log("outdiv is null....creating new outdiv");
              outdiv=document.createElement('div');
              outdiv.id=outdivid;
              console.log("new OUTDIV is created "+outdivid);
              rowcnt=1;
              
            }

            console.log("DISPLAY TASKS=LEVEL>1 loop.lvl="+currlvl);

            // set style for tasks whose level > 1

            divc1.style="border-left: 10px solid #5CB3FF;border-right: 1px solid #5CB3FF;"
            //

            // display task values in <h4>

            var h=document.createElement("H4");          
            h.appendChild(spanele);
            h.appendChild(tname);
            cntdiv.appendChild(h);

            //console.log("prevdivid="+prevdivid);
            // lvldivid='lvldiv'+currlvl+grpid;

            // if (currlvl != prevlvl)
            // {
            //   lvldiv=document.getElementById(lvldivid);
            //   if (lvldiv == null)
            //   {
            //     lvldiv=document.createElement('div');
            //     lvldiv.id=lvldivid;
            //     console.log('lvldiv='+lvldiv.id);
            //   }
            //   //prevdivid='lvldiv'+prevlvl+grpid;
            //   //prevdiv=document.getElementById(prevdivid);
            // }

            
          }


          //else
          //{
          //  elecnt=elecnt+1;
          //  console.log("element count "+elecnt+' for '+individ);
          //}
          

          outdiv.style="padding-left:10px;";

          divc1.appendChild(cntdiv);
          divc1.appendChild(tassignee);
          divc1.appendChild(tduedate);

          tdiv.appendChild(divc1);
          tdiv.appendChild(tskhr);
          encdiv.appendChild(tdiv);
          omdiv.appendChild(encdiv);
          outrow.appendChild(omdiv);

        //  outrow.style="border-left:2px solid green;"

          console.log("omdiv to be appended..."+omdiv.id);
          console.log("outdiv to be appended..."+outdiv.id);
          outdiv.appendChild(outrow);

          if (prevdivid !== outdivid && rowcnt==1)
          {
            outdiv.classList.add("singlerow");
          }

          if (prevdivid == outdivid && rowcnt > 1)
          {
            console.log("MULTIrow candidate...prevdivid="+prevdivid+' outdivid='+outdivid+' rowcnt='+rowcnt);
            outdiv.classList.remove("singlerow");
            outdiv.classList.add("multirows");
          }
          
              
          if (currlvl == 1)
            projrw.appendChild(outdiv);
          else
          {
            parent='outrow'+ptsk;
            parentrow=document.getElementById(parent);
            parentrow.appendChild(outdiv);
          }

          //previndid=individ;
          

          // partsk=tasksArr[i].parent_task_id;
          // var indiv1id='indiv1'+grpid+partsk;
          // var indiv1id=null;
          // console.log("in divid="+indiv1id);
          // indiv1id=document.getElementById(indiv1id);
          // console.log("GET ELEMENT indiv1id="+indiv1id);

          // if (indiv1id==null)
          // {
            // if (elecnt>1)
            // {
            //   console.log("has more than one row...previndid="+previndid);
            //   prevind=document.getElementById(previndid);
            //   prevind.classList.add('multirows');
            //   //prevind.appendChild('indiv1');
            // }

            // console.log("indiv1 is null...creating new indiv1..."+indiv1id);
            // indiv1=document.createElement('div');
            // console.log("indiv1 created..its id="+indiv1);
            // indiv1.id=indiv1id;
            // //indiv.style="padding-left:20px;";
            //elecnt=1;
          //}
          



       //   outdiv.classList.add('outdiv');
        //  omdiv.classList.add('omdiv');

          

          // store the old indiv in a variable and assign children tasks to it

          // previndid=indiv2id;
          // partsk=tasksArr[i].parent_task_id;
          // indiv1id='indiv1'+'_'+grpid+'_'+partsk;
          // indiv2id='indiv2'+'_'+grpid+'_'+partsk;

          

          // indiv2=document.getElementById(indiv2id);

          // if (indiv2 == null)
          // {
          //   if (elecnt>1)
          //   {
          //     console.log("has more than one row...previndid="+previndid);
          //     prevind=document.getElementById(previndid);
          //     prevind.classList.add('multirows');
          //     //prevind.appendChild('indiv1');
          //   }
          //   console.log("indiv is null...creating new indiv..."+indiv1id);
          //   indiv1=document.createElement('div');
          //   indiv1.id=indiv1id;
          //   indiv1.style="padding-left:20px;";
          //   indiv2=document.createElement('div');
          //   indiv2.id=indiv2id;
          //   elecnt=1;
          // }
          // else
          // {
          //   elecnt=elecnt+1;
          //   console.log("element count "+elecnt+' for '+indiv1id);
          // }

          // console.log("appending "+indiv1id+' with '+outdivid);

          // indiv2.appendChild(outdiv);

          // console.log("appending "+indiv2id+' with outdiv '+indiv1id);


          // indiv1.appendChild(indiv2);

          // indiv1.classList.add('indiv1');

          // console.log("added classlist for indiv1");

          //console.log("appendChild omdiv...");

          
        }
        for (i=0;i<grpidarr.length;i++)
          console.log("grpid array="+grpidarr[i]);

        var pos;
        var pos2;
        dividlst=document.getElementsByClassName("multirows");

        for (i=0;i<dividlst.length;i++)
        {

          dividstr=dividlst[i].id;
          console.log("dividstr="+dividstr);
          chlddiv=document.getElementById(dividstr).children;
          for (j=0;j<chlddiv.length;j++)
          {
            chlddiv[j].classList.add("leftbord");
          }
        }

        // List of parent divs that are part of the singlerow class

        pdividlst=document.getElementsByClassName("singlerow");

        for (i=0;i<pdividlst.length;i++)
        {
          console.log("pdividlst["+i+"]="+pdividlst[i].id);
          pdividstr=pdividlst[i].id;
          pdividstr1 = pdividstr.substring(pdividstr.search('_')+1);
          taskid = pdividstr1.substring(2,(pdividstr1.search('_')));
          
          if (taskid==173)
          {
          
          // parent row
          console.log("calling pub_getTaskPos_ByTaskid to get parentid..taskid="+taskid);
          pos=pub_getTaskPos_ByTaskid(tasksArr,taskid);
          prow=tasksArr[pos];
          plvl=prow.lvl;
          change_from_div="outdiv_pt"+prow.parent_task_id+"_160";

          //console.log("MASTER.."+"pos="+pos+" taskid="+taskid+" prow.taskid="+prow.id);

          // find first children (expected there should be only one child always)

          divid_chld_id=pdividlst[i].children[0].id;

          // format of child id=outrow<taskid>

          taskid=divid_chld_id.substring(6);

          
          // child row
          console.log("calling pub_getTaskPos_ByTaskid to get childid..taskid="+taskid);
          //console.log("calling pub_getTaskPos_ByTaskid to get the taskid position...");
          pos2=pub_getTaskPos_ByTaskid(tasksArr,taskid);
          crow=tasksArr[pos2];
          clvl=crow.lvl;

          console.log("CHILD ROW.."+"pub_getTaskPos_ByTaskid(taskid,tasksArr)="+pub_getTaskPos_ByTaskid(tasksArr,taskid)+"pos2="+pos2+" divid_chld_id="+divid_chld_id+"  taskid="+taskid+" crow.taskid="+crow.id+" childlvl="+clvl+" parentlvl="+plvl);

          //divid_prnt_id=dividlst[i].parentElement.id;
          
          //console.log("CHANGE PARENT... parent="+divid_prnt_id+'chld_id='+divid_chld_id);

          if (clvl > plvl)
          {
            console.log("LEVEL...childlevel is higher than the plvl...change parent div....");
            //newdiv=document.createElement('div');
            //newdiv.id='outdiv_pt'+prow.id+'_160a';
            //divid_chld=document.getElementById(divid_chld_id);
            //console.log("parent_div="+newdiv.id+" divid_chld="+divid_chld.id);
            //divid_prnt=document.getElementById(divid_prnt_id);
            //newdiv.appendChild(divid_chld);
          }
       
         }
       }
    }
     //   for (i=0;i<partsk.length;i++)
     //     console.log("partsk["+i+"]="+partsk[i]);

     //   var lstitm;

       // console.log("DRAW VERTICAL LINE....");

      //     for (j=0;j<partsk.length;j++)
      //     {
              
      //         grpid=partsk[j] [0];
      //         ptsk=partsk[j] [1];
      //         fstrwlvl=partsk[j] [2];
      //         //fstrwlvl=tasksArr[i].lvl;
      //         console.log("parent taskid="+ptsk);
      //         //fstrwlvl=tasksArr[pub_getTaskPos_ByTaskid(tasksArr,ptsk)].lvl;
      //         //currrwlvl=fstrwlvl;


      //         divid='outdiv_pt'+ptsk+'_'+grpid;
      //         console.log("the children to be found "+divid);

      //         chldcnt=document.getElementById(divid).children.length;
      //         lstitm=document.getElementById(divid).children[chldcnt-1].id;
      //         tskid=lstitm.substring(6);
      //         lstchlddiv=document.getElementById(lstitm);
      //         //document.getElementById(lstitm).children[k].id;
      //         lstitmlvl=tasksArr[pub_getTaskPos_ByTaskid(tasksArr,tskid)].lvl;
      //         console.log("last item="+lstitm+' lstitmlvl='+lstitmlvl);
              
      //         if (chldcnt>1 )
      //         {
      //           console.log(divid+' HAS '+chldcnt+' rows');
      //           for (k=0;k<chldcnt;k++)
      //           {
      //             chlddivid=document.getElementById(divid).children[k].id;
      //             console.log("INNER LOOP BORDER LEFT==chlddivid="+chlddivid);
      //             tskid=chlddivid.substring(6);
      //             pos=pub_getTaskPos_ByTaskid(tasksArr,tskid);
      //              // console.log("pos="+pos);
      //             currrwlvl=tasksArr[pos].lvl;
      //             console.log("currrwlvl="+currrwlvl+'frstlvl='+fstrwlvl);
      //             chlddiv=document.getElementById(chlddivid);

                  
      //               console.log("Setting left border...curlvl="+currrwlvl+"fstrwlvl="+fstrwlvl+"chlddivid="+chlddivid);
      //               //chlddiv.style='border-left: 2px solid #339933;'
      //               chlddiv.classList.add('leftbord');
                    
      //               if (chlddivid==lstitm ) //&& fstrwlvl<currrwlvl)
      //               {
      //                 console.log("the last item to be taken off from leftbord class "+lstitm);
      //                 cnt=document.getElementById(lstitm).children.length;
      //                 if (cnt < 2)

      //                   lstchlddiv=document.getElementById(lstitm).children[cnt-1];
      //                 console.log("the childitem of lastitm(outrow) "+lstchlddiv.id);
      //                // lstchlddiv.classList.add('unsetlb');  


      //               }
      //               //if (chlddivid==lastitm)
                      
                  
                  
      //           }

      //         }
      //         else if (chldcnt == 1  )
      //         {

      //           console.log("CHLDCNT=1; item="+lstitm);
      //            lstchlddiv.classList.add('unsetlb');  
      //            //lstchlddiv.style.setProperty('border','initial','important');
      //            //lstchlddiv.style="border-left:1px solid white;border-right:1px solid red";
      //         }
          
      //   }
      // }
    

    function pub_getTaskPos_ByTaskid(tasks,tskid) {
      
      var i=0;
      var row_found='N';

      for (i=0;i<tasks.length;i++)
      {
        //console.log("tasts.id="+tasks[i].id);
        if (tasks[i].id == tskid)
        {
          row_found='Y';
          break;
        }
      }

      if (row_found=='Y')
      {
       // console.log("from FUNCTION pub_getTaskPos_ByTaskid...I="+i+' taskid='+tskid);
        return(i);
      }
      else
      { 
        //console.log("from FUNCTION pub_getTaskPos_ByTaskid..NO MATCHING ROW FOUND.. taskid="+tskid);
        return(null);
      }
    }

    function pub_find_child_tasks(tasks,id,tskgrp) 
    {
      var k=0;
      var rettask=[]; 
      var j=0;
      var i=0;
      
      for (i=0;i<id.length;i++)
      {
        for (j=0;j<tasks.length;j++)
        {
          if ( tasks[j].parent_task_id==tasks[id[i]].id && tasks[j].group_id==tskgrp )
          {
            console.log("Found parent task for...parent_task_id & task_id="+tasks[j].parent_task_id+' '+tasks[id[i]]);
            rettask[k]=j;
            tasks[id[i]].has_child = "Y";
            k=k+1;
          }
        }
    
      }
      
      console.log("PUB_FIND_CHILD_TASKS...rettask.length="+rettask.length);
      return(rettask);

    }


      
		function pub_find_child_task(id,ocur=1) 
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


  function draw_vline_new()
   {
      var ptgrp='pt0';

      var tsks=[1];
      while (tsks.length > 0)
      {
        tsks=document.getElementsByClassName(ptgrp);
        outdiv=document.createElement(div);
        inrdiv=document.createElement(div);
        outdiv.appendChild(inrdiv);
        outdiv.id='outdiv'+ptgrp;
        inrdiv.id='inrdiv'+ptgrp;
        for(i=0;i<tsks.length;i++)
        {
          ptgrp=tsks[i];          
          tsks[i].parentNode.insertBefore(outdiv,tsks[i].parentNode.nextSibling);
        }
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

			var lstprocessed_pgrp=[];
			var lstprocessed_idx=0;

			var vprevgroup=0;
			var vgroup=0;

			// sets indention between task levels 

			var vleftpaddval=5;

			var vsitmlvl;

			var vinitlvlproc=0;
			var prevlvl1=0;

      		for(i=0;i<tasksOrdArr.length;i++)
      		{
      			vprcind=varrParChld[i];

      			console.log("BEGINNING OF VERTICAL LINE FOR LOOP");
      			console.log("taskid="+tasksOrdArr[i].id);

      			var processed='N';
      			var pi=0;
      			var pgrp='pt'+tasksOrdArr[i].parent_task_id;

      			vprevgroup=vgroup;
      			vgroup=tasksOrdArr[i].group_id;
      			prevlvl=vrtlvl;
      			vrtlvl=tasksOrdArr[i].lvl; 	

      			if (vprevgroup!==vgroup)
					prevlvl=0;
				
				tskdiv="t"+tasksOrdArr[i].id+"l"+tasksOrdArr[i].lvl;
      					
      			omdiv='om'+tskdiv;
      			omdivele=document.getElementById(omdiv);

				encdiv='enc'+tskdiv;
				encdivele=document.getElementById(encdiv);
				encdivele.classList.add('encdiv');
      			
      			
      			scrolladj=tasksOrdArr[i].lvl*2*15;
				scrollper=100+Math.round((1/(1023/scrolladj)*100),1);
				console.log("SCROLLPERCENT="+scrollper);				   		
		
				tskdivele=document.getElementById(tskdiv);
				tskdivele.style.setProperty('--scrollper', scrollper+'%' );    	    
				tskdivele.classList.add('tskitm');


      			for (pi=0;pi<lstprocessed_pgrp.length;pi++)
      			{
      					console.log("already processed parentgroups="+lstprocessed_pgrp[pi]);

      					if (lstprocessed_pgrp[pi]== pgrp)
      						processed='Y';
      				
      			}

				var itm=document.getElementsByClassName(pgrp);
			  	console.log("PARENT GROUP COUNT="+pgrp+' '+itm.length);

			  	
      			if ( processed =='N' )
				{
					if (itm.length > 1)
				  	{

      					
      					console.log('VLINE PROCESSING...encdiv=  encdivele='+encdiv+' '+encdivele);
				   		//tskdivele.style="width:"+scrollper+"%";

				  		lstprocessed_pgrp[lstprocessed_idx]=pgrp;
				   		lstprocessed_idx=lstprocessed_idx+1;

				   		// create new div called divout+pgrp

				   		
				   		vldivout='divout'+pgrp;
				   	   	vldivoutele=document.createElement('div');
				   	   	vldivoutele.id=vldivout;
				   	   	console.log("div id created vloutdivid="+vldivout);
				   	   	//vldivoutele.classList.add(pgrp);

				   	   	//tskdivele.parentNode.insertBefore(vldivoutele,tskdivele.nextSibling);

				   	   	
				   	   	//console.log('omdivele.nextsibling=prevsibling='+omdivele.nextSibling+'  '+omdivele.previousSibling+' '+omdivele.parentNode+' '+omdivele.childrenNode);
				   	   	omdivele.parentNode.insertBefore(vldivoutele,omdivele.nextSibling);



				   	   	// create new div called divin+pgrp
				   	   	
				   	   	vldivin='divin'+pgrp;
				   	   	vldivinele=document.createElement('div');
				   	   	vldivinele.id=vldivin;

				   	   	// add the div element to the vldivin class

				   	   	vldivinele.classList.add('vldivin');
				   	   	vldivoutele.appendChild(vldivinele);


				   	   	// set indention for each task items/groups

						vrtlvl1= ( vrtlvl - prevlvl )  * vleftpaddval;

						// first time after the single items are displayed, this variable, vsitmlvl is used for indenting new div group with children  

						console.log("vsitmlvl="+vsitmlvl);
						vrtlvl1=vrtlvl1+vsitmlvl;

						// reset vsitmlvl to zero, so that the next div with children will start from the current block or the next single item will start based on its level (refer the else part)

						vsitmlvl=0;
				   	   	
				   	   	console.log("VRTLVL prevlvl+vrtlvl="+prevlvl+' '+vrtlvl);

				   	   	// <==
				   	   	// set indent of the row based on its level
				   	   	// ==>

				   	   	root=document.getElementById(omdiv);
				   	   	console.log("omdiv="+root);
				   	   	if (vrtlvl1 == 0)
				   	   		vrtlvl1=vleftpaddval;

				   	   	
				   	   	console.log("the calculated value to be passed to --rtlvl="+vrtlvl1);
				   	   	root.style.setProperty('--rtlvl', vrtlvl1+'px' );
				   	   	root.style.getPropertyValue('--rtlvl');
				   	   	console.log("rootlevel set is,"+root.style.getPropertyValue('--rtlvl'));

				   	   	omdivele.classList.add('lftpad');
	      				

				   	   	// <==
				   	   	// find items in range & include them in the same div
				   	   	// ==>

				   		var vrange=[];
				   		var vrngitm=[];

				   		var fstitm=itm[0].id;
				   		
				   		var lstitm=itm[itm.length-1].id;
				   		console.log("fstitm=lastitm="+fstitm+' '+lstitm);
				   		
				   		fstitmele=document.getElementById(fstitm);
				   		lstitmele=document.getElementById(lstitm);
				   		
				   		var rofitms=get_itms_inrange();

				   		var i2=0;
				   		var chldid;

				   		for (i2=0;i2<rofitms.length;i2++)
				   		{

				   			//chldid='t'+rofitms[i2].id+'l'+rofitms[i2].lvl;
				   			chldid='omt'+rofitms[i2].id+'l'+rofitms[i2].lvl;
				   			console.log("RANGE OF ITEMS....rofitms[i2]="+chldid);

				   			

				   			chldele=document.getElementById(chldid);
				   			console.log("parent of before change "+chldid+" "+chldele.parentNode.id);
			   			
			   				
				   			vldivinele.appendChild(chldele);
	      					chldele.classList.add('lftpad');
	      					

				   			console.log("successfully appendChild is done on "+chldid);
				   			console.log("parent of after change "+chldid+" "+chldele.parentNode.id);
				   			
				   		}
				   		
				   		
				   		function find_pos(itm)
				   		{
				   			var curritm;
				   			var i=0;
				   			for (i=0;i<=tasksOrdArr.length;i++)
				   			{	
				   				//curritm='t'+tasksOrdArr[i].id+'l'+tasksOrdArr[i].lvl;
				   				curritm='omt'+tasksOrdArr[i].id+'l'+tasksOrdArr[i].lvl;
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
				   			
				   			// <==
				   			// find position of the last item
				   			// add +1 to include the last element too in resultarr
				   			// ==>

				   			l=find_pos(lstitm);
				   			
				   			
				   			console.log("startpos(i)=lastpos(l)"+i+' '+l);
				   			console.log("tasksOrdArr[i].length="+tasksOrdArr.length);

				   			
				   			while ( i <= l  && tasksOrdArr[i].lvl>1 )
				   			{
				   				//console.log("inside while curritm+startpos+lstitm"+i+" "+lstitm);
				   				resultarr[j]=tasksOrdArr[i];
				   				i=i+1;
				   				j=j+1;
				   			}
				   				console.log("get_itms_inrange ends here...");
				   				return resultarr;

				   		}	
				   	}
				   	else
				   	{
				   		// 
				   		// if the parent group of the current row contains no children
				   		// 


				   		console.log("THIS IS SINGLE ITEM WITHOUT NO CHILDREN..");
				   		console.log("vrtlvl=+prevlvl=vsitmlvl=prevlvl1=vrtlvl1"+vrtlvl+' '+prevlvl+' '+vsitmlvl+' '+prevlvl1+' '+vrtlvl1);

				   		// if vsitmlvl==0 means, either itm.length>1 loop was executed before or this is the first time this else condition is met and getting executed. vrtlvl1 is calculated in the if condition part of this loop.

				   		if (vsitmlvl == 0)
				   			prevlvl1=0;
				   		else				   			
				   			prevlvl1=vrtlvl1;

				   		if (vinitlvlproc !== tasksOrdArr[i].group_id)
				   		{
				   		   	vrtlvl1= vrtlvl * vleftpaddval;
				   		   	prevlvl1=0;
						}
						else
							vrtlvl1= prevlvl1+ ((vrtlvl-prevlvl) * vleftpaddval);


						// if parent node of the task item is the outer most div, then the indention should be only based on task's level

						console.log('itm[0]='+itm[0]);
						if (itm[0].parentNode.id == "outdiv34")
						{
							vrtlvl1= vrtlvl * vleftpaddval;
						}


						// The "vsitmlvl" variable below is used for indenting the tasks with children in the "if" clause above with itm.length>1
						


						vsitmlvl=vrtlvl1;
						vrtlvl1=vrtlvl1 + 15;
						vinitlvlproc=tasksOrdArr[i].group_id;
						
				   	   	console.log("the calculated value to be passed 2 --rtlvl="+vrtlvl1);
				   	   	itm[0].style.setProperty('--rtlvl', vrtlvl1+'px' );
				   	   	itm[0].children[0].style.setProperty('--scrollper', scrollper+'%' );
				   	   	console.log("rootlevel set is,"+vrtlvl1+'px');
				   	   	//itm[0].classList.add('encdiv');
						itm[0].classList.add('singleitem');
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
		<?php echo "<div class='col-xs-3'>" ?>
		<?php echo '<h4><span  id="projicon'. $project->id .'" class="glyphicon glyphicon-expand"></span>'.'<a id="ahglt'.$project->id.'" href='. base_url() ."projects/display/". $project->id .">"." ".$project->project_name . "</a></h4>" ?>

		<?php echo "</div>" ?>			
	
		<?php echo "<div class='col-xs-7'>" ?>
		<?php echo "<h4>".$project->project_body."</h4>" ?>
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
