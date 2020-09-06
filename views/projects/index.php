
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

		function get_projectid(project_id)
		{ 
      projicon=document.getElementById('projicon'+project_id);
			console.log("get_projectid is fired...icon="+projicon.className);
      fstitmid="p"+project_id+'_outdiv_pt0';
      fstitm=document.getElementById(fstitmid);



      if (projicon.className  == "glyphicon glyphicon-expand" && fstitm==null)
      {
          console.log("from GET_PROJECTID b4 XMLHttpRequest()");
          var xhttp = new XMLHttpRequest();
          xhttp.open("GET", "http://localhost/ci/tasks/list_tasks/".concat(project_id), true);
          console.log('this is after xhttp.open statement');
          xhttp.send();
          console.log('this is after xhttp.send');
  
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
                display_tasks(tasksArr);
                console.log("The calling of functions ends here...!!");
        				  
        			}
            }
          }
          
      }
      else if ((projicon.className  == "glyphicon glyphicon-expand" && fstitm !==null))
      {
        console.log("current value=glyphicon glyphicon-expand");
        projicon.className="glyphicon glyphicon-collapse-down";
        
        fstitm.classList.toggle('hiditm');
        prjendhr.classList.toggle('hiditm');
        
      }
      else if (projicon.className=="glyphicon glyphicon-collapse-down")
      {
        console.log("current value=glyphicon-collapse-down ");
        projicon.className="glyphicon glyphicon-expand";
        //projrw='projrw'+project_id;
        fstitm.classList.toggle('hiditm');
			  prjendhr.classList.toggle('hiditm');
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
      console.log("FIND_TASK_IDX called with ".concat(id));
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
        return(-1);

    }


  function get_user_lastloggedin()
  {

    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "http://localhost/ci/users/get_user_lastloggedin", true);
    console.log('this is after xhttp.open statement');
    xhttp.send();
    console.log('this is after xhttp.send');
  
          xhttp.onreadystatechange = function() 
          {
            
            if (this.readyState == 4 && this.status == 200)
            {
              console.log("responseText=".concat(this.responseText));
              //if (this.responseText.length > 3)
              //{
                var vlast_loggedin = JSON.parse(this.responseText); 
                console.log("vlast_loggedin="+vlast_loggedin[0].last_loggedin_at);
                var vlog=vlast_loggedin[0].last_loggedin_at;
                console.log("VLOG="+vlog);
              //}
            }
            return(vlog);
                
           }

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
              console.log("DISPLAY TASKS inner="+tasksArr[chldtsk[j]].
                id,' '+tasksArr[chldtsk[j]].task_name+' '+tasksArr[chldtsk[j]].parent_task_id+' '+tasksArr[chldtsk[j]].has_child);

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
        var hrgrpcnt=1;
        var partsk=[];
        var pcnt=0;

        // calling get_user_lastloggedin function

        var lstlogin=get_user_lastloggedin();
        console.log("LSTLOGIN="+lstlogin);




        
        for (i=0;i<tasksArr.length;i++)
        {
          console.log(tasksArr[i].id,tasksArr[i].task_name,tasksArr[i].parent_task_id,tasksArr[i].lvl,tasksArr[i].has_child);

          taskid=tasksArr[i].id;
          grpidarr[grpcnt]=grpid;
          grpid=tasksArr[i].group_id;
          
          prevlvl=currlvl;
          currlvl=tasksArr[i].lvl;
        
          // capture assignee & duedate to pass on to the URL for button click event

          var vassignee=tasksArr[i].assignee;
          var vduedate=tasksArr[i].due_date;
          
          console.log("VASSIGNEE="+vassignee);
          console.log("username="+tasksArr[i].username);


          //find the owner of the main task which is to be used to display "AskForUpdate" button
          if (currlvl==1)
            mt_owner=vassignee;


          login_user=tasksArr[i].username;

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


          // enclosing content div for providing scrollbar functionality

          encdiv=document.createElement('div');
          encdivid='enc'+taskid;
          encdiv.id=encdivid;


          // div for each task row

          tdiv=document.createElement('div');
          tdivid='tdiv'+taskid;
          tdiv.id=tdivid;
          
          if (currlvl>10)
          {
            tdiv.classList.add('tdiv');
            encdiv.classList.add('encdiv');
            scrolladj=currlvl*2*15;
            scrollper=100+Math.round((1/(1023/scrolladj)*100),1);
            console.log("SCROLLPERCENT="+scrollper);              
            tdiv.style.setProperty('--scrollper', scrollper+'%' );    
          }


          // horizontal line

          tskhr=document.createElement('hr');
          tskhrid="tskhr"+taskid;
          tskhr.id=tskhrid;
          tskhr.className="tskhr col-xs-12";


          tophr=document.createElement('hr');
          tophrid="tophr"+taskid;
          tophr.id=tophrid;
          tophr.className="tophr";
          tophr.style="width:100%";

          bothr=document.createElement('hr');
          bothrid="bothr"+taskid;
          bothr.id=bothrid;
          bothr.className="bothr";
          bothr.style="width:100%";

          // icon for tasks

          spanele=document.createElement("span");
          ikid="ic"+taskid;
          spanele.id=ikid;
          spanele.style="font-size:1.5em;"

          


          // assign icon based on whether task having children

          if (tasksArr[i].has_child=="N")
             spanele.className='glyphicon glyphicon-minus-sign disabled';
          else
              spanele.className='glyphicon glyphicon-plus-sign';
          
          

          // icon/image to indicate 'new' records

          var newimg = document.createElement("IMG");
          newimg.id='img'+tasksArr[i].id;
          newimg.setAttribute("src", "new.jpg");
          newimg.setAttribute("width", "50");
          newimg.setAttribute("height", "25");
          


          recstate=tasksArr[i].state;

          // content div 

          cntdiv=document.createElement('div');
          cntdiv.className='col-xs-12';


          // the outer div for holding task records, including all the fields

          divc1=document.createElement('div');
          divc1.id='divc1'+taskid;
          divc1.className="col-xs-12";
          divc1.classList.add("divc1");

          divtn=document.createElement('div');
          divtn.className="col-xs-5";


          // tndiv to hold task name (tname)
          //##########################################

          tndiv=document.createElement('div');
          tndiv.id='tndiv'+taskid;
          tndiv.className="col-xs-12";

          tname=document.createTextNode("  "+tasksArr[i].task_name.substring(0,25)+'('+tasksArr[i].id+')'+' '+tasksArr[i].lvl);
          //lbrk=document.createElement('br');
          


          // if parent task ==0, assign the current task's assignee & highest parent task date

          if ( ptsk>0)
          {
            parent_taskidx=find_task_idx(ptsk,tasksArr);
            pt_assignee=tasksArr[parent_taskidx].assignee;
            pt_ddate=tasksArr[parent_taskidx].due_date;
            console.log("PARENT TASK ptsk="+ptsk+' pt_ddate='+pt_ddate+'parent_taskidx='+parent_taskidx);
          }
          else 
          {
            pt_assignee=vassignee;
            pt_ddate='9999-12-31';
            console.log("PARENT TASK ptsk="+pt_assignee+' pt_ddate='+pt_ddate);
            
          }


          console.log("pt_assignee="+pt_assignee);
          updencdiv=document.createElement('div');
          updencdiv.className="col-xs-12";
          //updencdiv.style="font-weight:bold;font-size:10px;margin-bottom:10px"
          upddiv=document.createElement('div');
          upddiv.id='upddiv'+taskid;
          upddiv.className="col-xs-12";

          
          updlabeldiv=document.createElement('div');
          updlabeldiv.className="col-xs-12";
          updlabeldiv.id="updlabeldiv";
          updlabeldiv.style="margin-bottom:10px"
          updlabel=document.createTextNode("Latest Update");
          updlabeldiv.style="font-weight:normal;font-style:oblique;margin-bottom:5px;color:#2E4053";
          updlabeldiv.appendChild(updlabel);

          upddiv.appendChild(updlabeldiv);

          updtxtdiv=document.createElement('div');
          updtxt=document.createElement("TEXTAREA");
          //updtxt.className="col-xs-6";
          updbtndiv=document.createElement('div');


          // add_updbtn variable for adding button only when the conditions are met, otherwise that part is to be excluded from executing
          
          add_updbtn="false";
          if (tasksArr[i].username==vassignee || pt_assignee==tasksArr[i].username ||mt_owner==login_user) 
          {
            updbtn=document.createElement("BUTTON");
            updbtn.className="btn btn-success";
            add_updbtn="true";
          }

          if (tasksArr[i].username==vassignee)
          {
            console.log("Provide Update button fired");
            updbtn.innerHTML="Provide Update";

            updbtn.value="Provide Update";
          }
          else if (tasksArr[i].username==pt_assignee|| mt_owner==login_user)
          {
            console.log("Ask for Update button fired");
            updbtn.innerHTML="Ask For Update";
            updbtn.value="Ask For Update";
          }

          if (tasksArr[i].latest_update!==null)
            updtxt.defaultValue=tasksArr[i].latest_update;
          else
            updtxt.defaultValue="No updates available!";
          
          updtxt.rows=2;
          updtxt.maxLength=200;
          updtxt.readOnly=true;
          updtxt.cols=90;
          updtxt.style="background-color:#2E4053;color:white";
          updtxtdiv.className="col-xs-12";
          updtxtdiv.style="margin-bottom:10px;"
          updbtndiv.className="col-xs-12";
          
          
          updtxtdiv.appendChild(updtxt);
          //updtxtdiv.appendChild(updbtn);
          //updtxtdiv.style="font-color:#2E4053;color:#2E4053;background-color:#2E4053";
          upddiv.appendChild(updtxtdiv);
          
          
          console.log("LAST UPDATE DATE="+tasksArr[i].latestupd_datetime);
          if (tasksArr[i].latestupd_datetime!==null)
          {
            console.log("DATE VALUE IS AVAILABLE");
            upddatdiv=document.createElement('div');
            upddatdiv.style="margin-top:10px;";
            upddat=document.createTextNode(" Updated on "+tasksArr[i].latestupd_datetime);
            upddatdiv.className="col-xs-6";
            iupdele=document.createElement("span");
            iupdele.id="iupdele";
            iupdele.className="glyphicon glyphicon-calendar";
          
            upddatdiv.appendChild(iupdele);
            upddatdiv.appendChild(upddat);
            upddatdiv.style="color:#2E4053;"
            upddiv.appendChild(upddatdiv);

          }

          if (add_updbtn=='true')
          {
            updbtndiv.style="margin-top:10px;"
            updbtndiv.appendChild(updbtn);
            upddiv.appendChild(updbtndiv);


            updbtn.addEventListener('click', function(taskid,vassignee,pt_ddate,vduedate )
            {
              return function()
              {
                console.log("valueOfButton="+this.value);

                if (this.value=="Ask For Update")
                {
                  this.innerHTML="Email has been Sent";
                  this.className="btn btn-success glyphicon glyphicon-thumbs-up";
            
                  this.disabled="true";

                  //WRITE THE LOGIC FOR SENDING OUT EMAIL TO THE TASK OWNER HERE.......
                }
                else if (this.value=="Provide Update")
                {

                  window.open("http://localhost/ci/tasks/js_upd_task/"+taskid+'?ddate='+vduedate+'&ptd='+pt_ddate,'_self');
            
                }
              }
            }(taskid,vassignee,pt_ddate,vduedate )) ;

          }
          

          //upddiv.appendChild(updlabeldiv);
          updencdiv.appendChild(upddiv);
          updencdiv.style="margin-bottom: 20px; margin-top:10px; margin-left: 40px; margin-right: 10px; padding-right: 30px; border-left: 6px solid #008000; padding-bottom: 10px;";

          upddiv.style="margin-bottom: 15px;margin-left:-35px;margin-top:10px;";

          // adding toolbar, only if approved=0


          vapproved=tasksArr[i].approved;
          console.log("APPROVED="+vapproved);


          // Set task's status

         vstdiv=document.createElement('div');
         vstdiv.className='col-xs-4';
         //vstdiv.style="padding-left:30px; margin-top:10px; margin-bottom:10px;font-size:15px;font-weight-normal; ";


          vstatus=tasksArr[i].status;
          if (vstatus==1)
            vstatustxt=" Open";
          else if (vstatus==2)
            vstatustxt=" In Progress";
          else if (vstatus==3)
            vstatustxt=" Completed";
          else if (vstatus==null)
            vstatustxt=" Pending Approval";

          istatus=document.createElement("span");
          istatus.id="istatus";
          istatus.className="glyphicon glyphicon-warning-sign";
          


          //var vsttxt=document.createTextNode(" "+vstatustxt);
          vsttxt=document.createElement('p');
          //vsttxt2=document.createElement('p');
          vsttxt.id="vsttxt"+taskid;
          
          // 'p' element for istatus icon
          //vsticn=document.createElement('p');
          

          vsttxt.innerHTML='<span id="istatus" class="glyphicon glyphicon-warning-sign"></span>'+vstatustxt;
          //vstdiv.appendChild(istatus);
          //vsttxt.appendChild(vsttxt2);
          vstdiv.appendChild(vsttxt);
          //vsttxt.parentNode.insertBefore(vsticn,vsttxt.previousSibling);

          
          tlbrdiv=document.createElement('div');
          tlbrdiv.id='tlbrdiv'+taskid;
          tlbrdiv.className="col-xs-5";
          tlbrdiv.style="margin-top:20px;width:200px;float:right;";
          
          
          if (vapproved==0 )
          {
            

            addsibbtn=document.createElement("button");
            addchlbtn=document.createElement("button");
            modbtn=document.createElement("button");
            delbtn=document.createElement('button');
 
            addsibbtn.id="asbtn"+taskid;
            addchlbtn.id="acbtn"+taskid;
            modbtn.id="mdbtn"+taskid;
            delbtn.id="dlbtn"+taskid;
 
            addsibbtn.className="glyphicon glyphicon-plus";
            addchlbtn.className="glyphicon glyphicon-subscript";
            modbtn.className="glyphicon glyphicon-pencil";
            delbtn.className="glyphicon glyphicon-remove";

 
            // show add sibling only if the level is not equal to 1

            if (currlvl > 1)
            {
              console.log("add sibling NOT ALLOWED");
              tlbrdiv.appendChild(addsibbtn);
            }
            
            tlbrdiv.appendChild(addchlbtn);
            tlbrdiv.appendChild(modbtn);
            tlbrdiv.appendChild(delbtn);
            
            tlbrdiv.style="display:none";

            if (currlvl==1)
            {
              // expand recursively button
              expbtn=document.createElement('button');
            
              
              expbtn.id="exbtn"+taskid;
              expbtn.className="glyphicon glyphicon-triangle-bottom";
              
              tlbrdiv.appendChild(expbtn);
              
              // Listener for expandAll button

              expbtn.addEventListener('click', function(project_id,taskid,grpid)
              {
                return function()
                {
                  console.log(taskid+' button clicked'+vassignee);
                  for (i=0;i<tasksArr.length;i++)
                  {
                    if (tasksArr[i].group_id==grpid)
                    {
                      icn="ic"+tasksArr[i].id;
                      icnid=document.getElementById(icn);
                      icnid.className='glyphicon glyphicon-minus-sign';
                      console.log("icn="+icn);
                      if (tasksArr[i].has_child=='N')
                      {
                        icnid.className='glyphicon glyphicon-minus-sign disabled';
                      }
                      else
                      {
                       icnid.className='glyphicon glyphicon-minus-sign'; 
                      }
                        console.log("taskWithParent="+tasksArr[i].id+' '+tasksArr[i].parent_task_id+' '+tasksArr[i].task_name+" "+tasksArr[i].lvl+" "+tasksArr[i].has_child);
                        
                        divid="outdiv_pt"+tasksArr[i].parent_task_id+"_L"+tasksArr[i].lvl+"_"+tasksArr[i].group_id;
                        console.log("divid="+divid);

                        divele=document.getElementById(divid);
                        if (tasksArr[i].lvl>1)
                          divele.style="padding-left:20px;display:block";
                        //divele.style.display="block";
                      //}
                    }

                    }
                  
                }
              }(project_id,taskid,grpid));


            
            }

            // add event listener to all buttons




            // add children button click event

            addchlbtn.addEventListener('click', function(project_id,vassignee,taskid,grpid,vduedate,pt_ddate)
            {
              return function()
              {
                console.log(taskid+' button clicked'+vassignee);
                //var assigneeid=document.getElementById(iassgneleid).value;
               

                window.open("http://localhost/ci/tasks/js_add_task/"+project_id+'?assignee='+vassignee+'&parent_task_id='+taskid+'&groupid='+grpid+'&due_date='+vduedate+'&pt_duedate='+pt_ddate,'_self');


              }
            }(project_id,vassignee,taskid,grpid,vduedate,pt_ddate));


            // del button click event

            delbtn.addEventListener('click', function(taskid,grpid)
            {
              return function()
              {
                //window.confirm("Are you sure you want to delete the task "+taskid);

                if (confirm("Confirm delete task "+taskid))
                    window.open("http://localhost/ci/tasks/js_del_task/"+taskid+'?groupid='+grpid,'_self');


              }
            }(taskid,grpid));




            // add sibling button click event
            
            addsibbtn.addEventListener('click', function(project_id,vassignee,ptsk,grpid,vduedate,pt_ddate)
            {
              return function()
              {
                console.log(taskid+' button clicked'+vassignee);
                //var assigneeid=document.getElementById(iassgneleid).value;
                
                
                window.open("http://localhost/ci/tasks/js_add_task/"+project_id+'?assignee='+pt_assignee+'&parent_task_id='+ptsk+'&groupid='+grpid+'&due_date='+vduedate+'&pt_duedate='+pt_ddate,'_self');

              }
            }(project_id,vassignee,ptsk,grpid,vduedate,pt_ddate));

          }
          


          
          // column #2 & column #3

          c2div=document.createElement('div');
          c3div=document.createElement('div');
          c4div=document.createElement('div');

          c2div.className="col-xs-5";
          c3div.className="col-xs-3";
          //c4div.className="col-xs-10";

        
          
          
          // icon for asssignee value

          iassgnele=document.createElement("span");
          var iassgneleid='iassgnele'+taskid;
          iassgnele.id=iassgneleid;
          iassgnele.className="glyphicon glyphicon-user";


          // icon for due date value

          iduedtele=document.createElement("span");
          iduedtele.id="iduedtele";
          iduedtele.className="glyphicon glyphicon-calendar";
          
          // create text nodes for Assignee & duedate

          tassignee=document.createTextNode(" "+vassignee);
          tduedate=document.createTextNode(" "+vduedate);
          tassignee.id='tassignee'+taskid;


          c1div=document.createElement('div');
          c1div.className="col-xs-12";

          // c2div for icon & text for assignee

          c2div.appendChild(iassgnele);
          c2div.appendChild(tassignee);

          //c2div.className="col-xs-9";
          // c3div for icon & text for duedate

          c3div.appendChild(iduedtele);
          c3div.appendChild(tduedate);

          //c3div.className="col-xs-3";
          c1div.appendChild(c2div);
          c1div.appendChild(vstdiv);
          c1div.appendChild(c3div);

          // create text nodes for Approval status

          
          vusername=tasksArr[i].username;

          if (vapproved==1 && tasksArr[i].username!==pt_assignee)
          {

            iapprele=document.createElement("span");
            var iappreleid='iapprele'+taskid;
            iapprele.id=iappreleid;
            iapprele.className="glyphicon glyphicon-warning-sign";
            
            tapproved="Approval Pending";

            tapprove=document.createTextNode(" "+tapproved);
            
            
            // c4div for icon & text for approval status
          
            c4div.style="color:red;margin-top:10px;margin-bottom:10px;font-weight:bold;font-size:20px;";
            c4div.appendChild(iapprele);
            c4div.appendChild(tapprove);
            c2div.appendChild(c4div);

          }
          else if (vapproved==1 && tasksArr[i].username==pt_assignee)
          {
            console.log("SHOW APPROVE BUTTON");
            appbtn=document.createElement('button');
            appbtn.id='appbtn'+taskid;
            appbtn.className="btn btn-success";
            appbtn.innerHTML="Approve";

            c4div.style="margin-top:10px;margin-bottom:10px;font-weight:bold;font-size:20px;";
            c4div.appendChild(appbtn);
            c2div.appendChild(c4div);

            appbtn.addEventListener('click', function(taskid,vsttxt)
            {
              return function()
              {
                console.log(taskid+' button clicked'+vassignee);
             
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() 
                {
                  if (this.readyState == 4 && this.status == 200) 
                  {
                    console.log('appbtn xhttp readystate....'+this.responseText);
                    if (this.responseText==1)
                    {
                      btn=document.getElementById('appbtn'+taskid);
                      btn.innerHTML="Approved!";
                      btn.className="btn btn-success glyphicon glyphicon-thumbs-up";
                      
                      btn.disabled=true;
                      vsttxt=document.getElementById('vsttxt'+taskid);
                      vsttxt.innerHTML='<span id="istatus" class="glyphicon glyphicon-warning-sign"></span>'+' Open';

                      vsttxt.innerHTML='<span id="istatus" class="glyphicon glyphicon-warning-sign"></span>'+vstatustxt;
                      
                    }

                  }
                };
                xhttp.open("GET", "http://localhost/ci/tasks/js_approvetask/"+taskid, true);
                xhttp.send();
                
              }
            }(taskid));


          }



          // Append child items

          
          c3div.style="margin-bottom:30px;float:right";
          
          
          // if task level == 1 (root task), assign a different style from the ones having level > 1
          
          ptsk=tasksArr[i].parent_task_id;          
          
          if (grpidarr[grpcnt] !== grpid)  
          {
            grpcnt=grpcnt+1;
            grpidarr[grpcnt]=grpid;
          }
          

          prevdivid=outdivid;
          outdivid='outdiv_pt'+ptsk+'_L'+currlvl+'_'+grpid;


          outrowid='outrow'+taskid;
          outrow=document.createElement('div');
          outrow.id=outrowid;



          if (currlvl==1 && tasksArr[i].has_child=='Y')
          {
 


            // create outdiv_pt0 to hold all 1st level elements of different group_id

            pt0divid='p'+project_id+'_outdiv_pt0';
            pt0div=document.getElementById(pt0divid);
            endhrid='hr_'+taskid;
            
            if (pt0div == null)
            {
              pt0div=document.createElement('div');
              pt0div.id=pt0divid;
              pt0div.className="col-xs-10";
              pt0div.classList.add("outrbrdr");
            }

            outdiv=document.createElement('div');  
            outdiv.id=outdivid;
            
          
            // set style for divc1
            

            divc1.classList.add('divc1_lvl1');
          
          //  divc1.style="height:175px;border-left: 10px solid #2E4053;border-right: 10px solid #2E4053;#background-color:#897F7F ;color:#2E4053;padding-left:0px;padding-right:0px;border-radius: 25px; margin-bottom:1px;transition-delay: 0.5s;" ;

            
            rtdiv=document.createElement('div');
            rtdiv.id='rtdiv'+taskid;
            rtdiv.className="col-xs-6 rtdiv";

                      
            rtdiv.appendChild(spanele);
            rtdiv.appendChild(tname);
            //rtdiv.appendChild(tndiv);

            if (recstate=='new')
              rtdiv.appendChild(newimg);

            // change tname (task name) style properties 
           // rtdiv.style="padding-bottom:20px;"

            cntdiv.appendChild(rtdiv);
            
            cntdiv.style="font-size:20px;font-weight:bold;padding-top:10px";
            
            //cntdiv.appendChild(vsttxt);

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

            divc1.classList.add('divc1_gt_lvl1');

          //  divc1.style="height:175px;border-left: 10px solid #5CB3FF;border-right: 10px solid #5CB3FF;color:#2E4053;padding-left:0px;padding-right:0px;border-radius: 15px; margin-bottom:1px;transition-delay: 0.5s";
            

            // display task values in <h4>


            rtdiv=document.createElement('div');
            rtdiv.id='rtdiv'+taskid;
           // rtdiv.style="font-size: 20px; font-weight: bold; padding-top: 10px;"
            rtdiv.className="col-xs-7 rtdiv";
            //var h=document.createElement("H4");          

            rtdiv.appendChild(spanele);
            rtdiv.appendChild(tname);
            

            if (recstate=='new')
              rtdiv.appendChild(newimg);

           // cntdiv.appendChild(vstdiv);
            cntdiv.appendChild(rtdiv);
            //cntdiv.style="margin-bottom:10px;"
            //cntdiv.style="font-size:15px;font-weight:bold;";
          }

          // color properties for the rtdiv
          rtdiv.style="color:#2E4053;font-weight:bold;transition-delay: 0.5s;"
         // divc1.style="transition-delay: 0.5s;"
          
        
          cntdiv.appendChild(tlbrdiv);
          divc1.appendChild(cntdiv);
          //divc1.appendChild(vstdiv);
        
          divc1.appendChild(updencdiv);
          divc1.appendChild(c1div);
          

          //divc1.appendChild(bothr);

          tdiv.appendChild(divc1);
          tdiv.appendChild(bothr);

          if (currlvl>1)
            encdiv.appendChild(tophr);

          encdiv.appendChild(tdiv);
          omdiv.appendChild(encdiv);
          outrow.appendChild(omdiv);
          outdiv.appendChild(outrow);

          if (prevdivid !== outdivid && rowcnt==1)
          {
            outdiv.classList.add("singlerow");
          }

          if (prevdivid == outdivid && rowcnt > 1)
          {
            outdiv.classList.remove("singlerow");
            outdiv.classList.add("multirows"+grpid);
          }
          
              
          if (currlvl == 1)
          {
            
            if (hrgrpcnt>1)
            {
              // add horizontal line to the end of the task group

              console.log("THIS IS LEVEL 1 & hrgrpcnt > 1");
              endhr=document.createElement('hr');
              endhr.id=endhrid;
              endhr.className="endhr col-xs-12";
              pt0div.appendChild(endhr);
            
            }
            
            pt0div.appendChild(outdiv);
            projrw.appendChild(pt0div);
            outdiv.style="padding-left:0px;"  
            pt0div.classList.add("leftbord");
  
            // counter to draw a horizontal line at end of each group

            hrgrpcnt=hrgrpcnt+1;
          }
          else
          {
            parent='outrow'+ptsk;
            parentrow=document.getElementById(parent);
            parentrow.appendChild(outdiv);
            outdiv.style="display:none";
          }



          // add event listener on each of the collapse/expand icon

        
        
          // Note: Enclosure function is used, as the current value of the // parameter in the loop could not be passed
          
          var iknele=document.getElementById(ikid);
          console.log("ADD EVEN LISTENER TO... ="+ikid);
          iknele.addEventListener('click', function(tasksArr,i)
          {
            return function()
            {
              thisid=this.id;
              console.log("icon id="+thisid);
              icn=document.getElementById(thisid);
              thistaskid=tasksArr[i].id;
              thisgrpid=tasksArr[i].group_id;



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

              // calculate next level

              vlvl=tasksArr[i].lvl;
              vlvl=Number(vlvl)+1;

              chldid='outdiv_pt'+thistaskid+'_L'+vlvl+'_'+thisgrpid;
              console.log("chldid whose display property to be changed..."+chldid);
              chld=document.getElementById(chldid);
                  

              if (tasksArr[i].has_child=='Y')
              {
                if (icn.className=='glyphicon glyphicon-minus-sign')
                {
                  console.log("BEGINNING OF COLLAPSE NODES");
                  icn.className='glyphicon glyphicon-plus-sign';
                  
                  // set div id's  display off

                  chld.style="padding-left:20px;display:none";
                  
                }
                else if (icn.className=='glyphicon glyphicon-plus-sign')
                {
                  console.log("BEGINNING OF expanding NODES");
                  icn.className='glyphicon glyphicon-minus-sign';

                  // set div id's display on
                  
                  chld.style="padding-left:20px;display:block";
                }

              }

            }
          }(tasksArr,i));



          // mouse over event on divc1

        
        // This handler will be executed every time the cursor
        // is moved over a different list item

        divc1.addEventListener("mouseover", function( event ) {   
          // highlight the mouseover target
          console.log("MOUSEOVER event fired");
          //this.style.backgroundColor = "orange";
          //this.style.cursor = "pointer";
          //this.style.color = "white";
          this.classList.add('tskhglt');
          taskid=this.id.substring(5);

          console.log("this id="+this.id+'.'+taskid);
          rtdiv=document.getElementById('rtdiv'+taskid);
          //rtdiv.style="margin-bottom:10px;border-bottom: 2px solid red";
          rtdiv.classList.remove("rtdiv");
          rtdiv.classList.remove("rtdivmot");
          rtdiv.classList.add("rtdivmov");
          
           
          if (vapproved==0)
          {
            tlbrdiv=document.getElementById('tlbrdiv'+taskid);
            tlbrdiv.style="display:block;margin-top:20px;#width:200px;float:right;";
          }
            
          }, false);

        divc1.addEventListener("mouseout", function( event ) {   
          // highlight the mouseover target
          console.log("MOUSEOUT event fired");
          //this.style.backgroundColor = "";   
          //this.style.color = "";
          //this.style.cursor = "default";

          this.classList.toggle('tskhglt');
          taskid=this.id.substring(5);
          rtdiv=document.getElementById('rtdiv'+taskid);
          rtdiv.classList.remove("rtdivmov");
          rtdiv.classList.remove("rtdiv");
          rtdiv.classList.add("rtdivmot");
          if (vapproved==0)
          {
            tlbrdiv=document.getElementById('tlbrdiv'+taskid);
            tlbrdiv.style="display:none";
          }
        }, false);


        divc1.addEventListener("dblclick", function( vassignee,vusername,pt_assignee,vstatus,vapproved,pt_ddate,vduedate ) 
        {
          return function()   
          {
            // disable display of new record indicator, if any
            console.log("MOUSE DOUBLE CLICK event fired");
            taskid=this.id.substring(5);
            console.log("this id="+this.id+'.'+taskid);


            newimgitm=document.getElementById('img'+taskid);
            if (newimgitm !== null)
              newimgitm.style="display:none" ;

            // call task update form

            console.log("vusername="+vusername+' ptassignee='+pt_assignee+' vassignee='+vassignee+' status='+vstatus+'vapproved='+vapproved);
            

            if ((vstatus !== 3 && vusername==pt_assignee) ||(vusername==vassignee && vapproved==0  && vstatus <3 && vstatus!==null))
            {
                console.log("UPDATE TASK IS TO BE CALLED");
                window.open("http://localhost/ci/tasks/js_upd_task/"+taskid+'?ddate='+vduedate+'&ptd='+pt_ddate,'_self');
            }
            else
            {
              alert("You are not authorised to perform update operation");
            }
          }
         
          } (vassignee,vusername,pt_assignee,vstatus,vapproved,pt_ddate,vduedate ) );



        // End of mouse over/mouse enter event triggers




          // end of the for Loop
        }

        prjendhr=document.createElement('hr');
        prjendhrid="prjendhr"+project_id;
        prjendhr.id=prjendhrid;
        prjendhr.className="prjendhr col-xs-10";
        projrw.appendChild(prjendhr);

        
        function find_child_tasks(pid)
              {
                var i=0;
                var chi=[];
                chiidx=0;
                for (i=0;i<tasksArr.length;i++)
                {
                  if (pid==tasksArr[i].parent_task_id)
                  {
                    chi[chiidx]=tasksArr[i].id;
                    chiidx=chiidx+1;
                  }
                }

                return chi;

              }

              
        for (g=0;g<grpidarr.length;g++)
        {
           console.log("grpid array="+grpidarr[g]);

        
            // drawing vertical Line 

            grpid=grpidarr[g];
            dividlst=document.getElementsByClassName("multirows"+grpid);

            for (i=0;i<dividlst.length;i++)
            {

              dividstr=dividlst[i].id;
              console.log("OUTDIVID="+dividstr);
              chlddiv=document.getElementById(dividstr).children;


              for (j=0;j<chlddiv.length;j++)
              {


                console.log("Adding into leftbord PARENT OUTROW="+chlddiv[j].id);

                chlddiv[j].classList.add("leftbord");
                chlddiv[j].classList.add("col-xs-12");

              }
            }

            for (i=0;i<tasksArr.length;i++)
            {
              console.log(tasksArr[i].id,tasksArr[i].task_name,tasksArr[i].parent_task_id,tasksArr[i].has_child);
            }

        }    
                         
      
      }
       
        

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


    function find_child_tasks_by_taskid(tasks,taskid,tskgrp)
    {
      var i=0;
      var cnt=0;
      var retArr=[];
      for(i=0;i<tasks.length;i++)
      {
        if (tasks[i].parent_task_id==taskid && tasks[i].group_id==tskgrp)
        {
          retArr[cnt]=i;
          cnt=cnt+1;
        }

      }
      return retArr;

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

	
       // manage_tasktabs();
        function manage_tasktabs() 
        {
          console.log("CALLING MANAGE_TASKTABS.......");
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
					console.log("(1)find_task_idx=found the task_id"+(i));
					break;
				}
			}
			//console.log("(2)find_task_idx index=".concat(i));
			if (found=='true')
      { 
        consone.log("found the task_id"+i);
			   return(i);
      }
			else
        {
          CONSOLE.log("NOT FOUND THE TASKID");
          i=null;
				  return(i);
        }

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
		
		<?php echo "<div id='projrw".$project->id."'>" ?>	
    
		<?php echo "<div id='divhglt".$project->id."' class='col-xs-10'>" ?> 
		<?php echo "<div class='col-xs-3'>" ?>
		<?php echo '<h4><span  id="projicon'. $project->id .'" class="glyphicon glyphicon-expand"></span>'.'<a id="ahglt'.$project->id.'" href='. base_url() ."projects/display/". $project->id .">"." ".$project->project_name . "</a></h4>" ?>

		<?php echo "</div>" ?>			
	
		<?php echo "<div class='col-xs-7'>" ?>
		<?php echo "<h4>".$project->project_body."</h4>" ?>
		<?php echo "</div>" ?>			

	
		<?php echo "<div class='col-xs-1, pl-0'>" ?>
	
		<a class="btn btn-primary" href='<?php echo base_url() ."projects/del_proj/". $project->id ?>'><span class="glyphicon glyphicon-remove"></span></a>

    <?php echo "</div>" ?>
    <?php echo "</div>" ?>
        
    

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
    

		

	<?php endforeach ?>
		
		<?php echo "</div>" ?>	
		<?php echo "</p>" ?>					
		<?php echo "</p>" ?>				
	
<?php 

   	
?>			
