<? php

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
      			tdiv1.style="margin-bottom:0px;margin-top:0px;padding-top: 0px;padding-bottom: 0px;border-left: 2px solid #897F7F; #border-style:solid;"
      			var tskid=tasksOrdArr[i].id;
      			tdiv1_id="t"+tskid+"l"+tasksOrdArr[i].lvl
      			tdiv1.id=tdiv1_id;
      	
      		
      			tskhr=document.createElement('hr');
      			tskhr.style="margin-top:10px;margin-bottom:10px;padding-top: 0px;padding-bottom: 0px;border: 0.01px solid #5CB3FF";
      			tskhr.id="hr"+tskid;


      			console.log("tskid="+tskid);
      			
      			spanele=document.createElement("span");
      			ikid="ic"+tskid+'l'+tasksOrdArr[i].lvl;
      			spanele.id=ikid;


      			
      			vprcind=varrParChld[i];
      			if (vprcind=="C")
      				 spanele.className='glyphicon glyphicon-minus-sign disabled';
      			else
      			{
      			   spanele.className='glyphicon glyphicon-plus-sign';

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
      					tdiv1id.classList.add("row",'outdiv');
      			

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
	      				console.log("current value of --lvl= & vbg="+vlvl+vbg);
	      				
	      				console.log((tasksOrdArr[idx].lvl*vlvl)+'px' );
	      				
	      				tdiv1id.classList.add('lvl1');
	      				vlvl2=getComputedStyle(document.documentElement).getPropertyValue('--lvl');
	      				console.log("the current value of --lvl="+vlvl2);
	      				
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
      
     }
      
 
 ?>