// document.addEventListener('loadeddata',function(){

    const bahan=document.getElementsByClassName('bahan')
    let context=document.getElementsByClassName('context')[0]
    let tools=document.getElementsByClassName('tools')[0]
    const popup=document.getElementsByClassName('popup')[0]
    const save=document.getElementById('save')

    save.addEventListener('click',function(e){
        const loading=document.querySelectorAll('.loading')[0]
        loading.style.display='flex'

        let formData=new FormData()
        formData.append('create','create')
        formData.append('template',context.outerHTML)
        formData.append('namafile',document.getElementById('namafile').value)
        const data={
            create:'create',
            template:'template'
        }
    // console.log(data)
        
        fetch('http://localhost/bendung-skema/save_file.php',{
            method:'POST',
            // headers:{
            //     'Content-Type':'application/json'
            // },
            body:formData
        }).then(res=>{
            // console.log(res)
            return res.json()
        }).then(result=>{
            console.log(result,'result')
            setTimeout(()=>{loading.style.display='none'},1000)
            
        }).catch(error=>{
            console.log(error,'catch')
            setTimeout(()=>{loading.style.display='none'},2000)
        })
    })

    // tools events
    document.getElementsByClassName('tools')[0].addEventListener('click',(ev)=>{
        console.log(ev.target)
        const target=ev.target
        if(target.classList.contains('tools-item')){
            
            let childs=tools.children
            let bahan;
            for (let index = 0; index < childs.length; index++) {
                if(childs[index].classList.contains(target.dataset.target)){
                    bahan=childs[index]
                }
            }
            const newEl=bahan.cloneNode(true)
            newEl.style.position='absolute'
            newEl.style.top='20%'
            newEl.style.left='20%'
            context.appendChild(newEl)
        }
    })

    context.addEventListener('dblclick',(event)=>{
        let target=event.target
        if(target.classList.contains('bahan')){
            console.log(target)
            popup.style.display='block'
            popup.style.top=event.clientY+"px"
            popup.style.left=event.clientX+"px"
            
            popup.addEventListener('click',(pop)=>{
                // pop.preventDefault()
                if(pop.target.classList.contains('resize')){
                    resize(target,popup)
                    target=null
                }else if(pop.target.classList.contains('rotate')){
                    let dataRot;
                    if(target != null){
                        dataRot=Number(target.dataset.rot)+15
                        target.style.transform=`rotate(${dataRot}deg)`
                        target.dataset.rot=dataRot
                    }
                }else if(pop.target.classList.contains('remove')){
                    context.removeChild(target)
                    console.log(target)
                    popup.style.display='none'
                    target=null
                }else if(pop.target.classList.contains('close')){
                    popup.style.display='none'
                    target=null
                }else if(pop.target.classList.contains('bg')){
                    
                    const bg=document.getElementById('bg')
                    
                    bg.addEventListener('input',(col)=>{
                        
                        target.style.backgroundColor=col.target.value
                    })
                }else if(pop.target.classList.contains('color')){
                    const color=document.getElementById('color')
                    console.log('color')
                    color.addEventListener('input',(col)=>{
                        
                        target.style.color=col.target.value
                    })
                }else if(pop.target.classList.contains('animated')){
                    target.classList.add('animated')
                    console.log('test')
                }
            })

        }
    })

    // context event
    context.addEventListener('mousedown',(event)=>{ 
        var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        pos3 = event.clientX;
        pos4 = event.clientY;
        if(event.target.classList.contains('bahan')){
            
            
            context.addEventListener('mousemove',mouseMove)
            let top=event.target.offsetY
            let left=event.target.offsetX


            function mouseMove(mo){

                mo.preventDefault()
                pos1 = pos3 -mo.clientX;
                pos2 = pos4 -mo.clientY;
                pos3 =mo.clientX;
                pos4 =mo.clientY;

                event.target.style.top = (event.target.offsetTop - pos2) + "px";
                event.target.style.left = (event.target.offsetLeft - pos1) + "px";
                // top=mo.offsetY
                // left=Number(mo.clientX)-Number(context.offsetLeft)
                // console.log(event.target.offsetTop,'offsetTop target')
                // event.target.style.top=top+"px"
                // event.target.style.left=left+"px"
            }
            context.addEventListener('mouseup',(up)=>{
                
                context.removeEventListener('mousemove',mouseMove)
            })
        }

    })

    function resize(el,parent){
        let inputWidth=prompt('width')
        if(inputWidth !== ""){
            el.style.width=inputWidth+"px"
            parent.style.display='none'
        }
    }

    context.addEventListener('click',(e)=>{
        if(e.target.classList.contains('lokasi')){
            // console.log('lokasi click')
            
            let opt=e.target.options[e.target.selectedIndex]
            opt.setAttribute("selected",true)
        }
    })


// })


// panah resize

// const panah=document.getElementsByClassName('panah')[0]

// function resizePanah(e){
//     context.addEventListener('mousemove',resize)
//     context.addEventListener('mouseup',stopResize)

//     // console.log(e)
//     let sibling=e.target.nextElementSibling || e.target.previousElementSibling
//     // console.log(sibling)
//     function resize(r){
//         console.log('resizze')
//         sibling.style.width=r.clientX+"px"
//         sibling.style.height=r.clientY+"px"
//     }

//     function stopResize(s){
//         s.preventDefault()
//         context.removeEventListener('mousemove',resize)
//     }
// }

// const line=document.querySelectorAll('.line')[0]
// line.addEventListener('click',(e)=>{
//     console.log('click')
//     let panjang=5
//     let target=e.target
//     let clone=target.cloneNode(true)
//     clone.style.width=panjang+"px"
//     clone.style.height=5+"px"
//     // clone.style.borderRadius="50%"
//     clone.style.position="absolute"
//     context.appendChild(clone)

//     let isStart=false
//     let startPos=0
//     let endPos=0
    

//     context.addEventListener('mousemove',move)
    
//     function move(emove){
//         if(isStart){
//             panjang=emove.clientX-startPos
            
//             console.log(panjang)
//         }else{
//             console.log('not start')
//             clone.style.top=emove.clientY+"px"
//             clone.style.left=emove.clientX+"px"
//         }
//     }

//     clone.addEventListener('mousedown',(md)=>{
//         console.log(md)
//         isStart=true
//         move(md)
//         startPos=md.clientX        
//     })

//     clone.addEventListener('mouseup',(mp)=>{
//         if(isStart){
//             console.log('done')
//             clone.style.width=panjang+"px"
//             clone.style.left=startPos+"px"
//             context.appendChild(clone)
//             isStart=false
//         }
//         context.removeEventListener('mousemove',move)
//     })
// })





