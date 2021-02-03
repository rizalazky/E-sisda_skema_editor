// document.addEventListener('loadeddata',function(){

    const bahan=document.getElementsByClassName('bahan')
    let context=document.getElementsByClassName('context')[0]
    let tools=document.getElementsByClassName('tools')[0]

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
            setTimeout(()=>{loading.style.display='none'},2000)
            
        }).catch(error=>{
            console.log(error,'catch')
            setTimeout(()=>{loading.style.display='none'},2000)
        })
    })

    // tools events
    document.getElementsByClassName('tools')[0].addEventListener('click',(ev)=>{
        if(ev.target.classList.contains('bahan')){
            const bahan=ev.target
            const newEl=bahan.cloneNode(true)

            newEl.style.position='absolute'
            newEl.style.top='50%'
            newEl.style.left='50%'

            context.appendChild(newEl)
        }
    })

    // context event
    context.addEventListener('mousedown',(event)=>{ 
        if(event.target.classList.contains('bahan')){
            // button action (remove,resize,rotate) show when right click
            if(event.which == 3){
                // muncul popup resize dll
                let child=event.target.children[0]
                child.style.display='flex'
                let status=false
                child.addEventListener('click',(pop)=>{
                    pop.preventDefault()
                    if(pop.target.classList.contains('resize')){
                        resize(event.target,child)
                    }else if(pop.target.classList.contains('rotate')){

                        let dataRot=Number(event.target.dataset.rot)+15
                        event.target.style.transform=`rotate(${dataRot}deg)`
                        event.target.dataset.rot=dataRot
                        const newCloseBtn=document.createElement('button')
                       
                        newCloseBtn.innerText='Close'
                        newCloseBtn.addEventListener('click',(close)=>{
                            child.style.display='none'
                            child.removeChild(close.target)
                        })
                        
                        if(!status){
                            child.appendChild(newCloseBtn)
                            status=true
                        }
                        
                    }else if(pop.target.classList.contains('remove')){
                        context.removeChild(event.target)
                    }
                }) 
            } 
            context.addEventListener('mousemove',mouseMove,true)
        
            function mouseMove(mo){
                
                mo.preventDefault()
                console.log(mo)
                console.log(event.target.offsetTop,'offsetTop target')
                event.target.style.top=Number(mo.clientY)-Number(context.offsetTop)+"px"
                event.target.style.left=Number(mo.clientX)-Number(context.offsetLeft)+"px"
            }
            context.addEventListener('mouseup',(up)=>{
                console.log('test')
                context.removeEventListener('mousemove',mouseMove,true)
            })
        
        }

    })

    function resize(el,parent){
        console.log(el)
        let inputWidth=prompt('width')
        if(inputWidth !== ""){
            el.style.width=inputWidth+"px"
            parent.style.display='none'
        }
    }

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





