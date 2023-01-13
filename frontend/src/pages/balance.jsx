import React, { useState } from 'react';

import Header from "../component/header";

function InputArray() {
   

   
    const handleChange = (event) => {
        setInputValue(event.target.value);
        setMontant(event.target.value);
        setNewValue(event.target.value);
    }
   
    
      const [data, setData] = useState([
        { QuiAPaye: 'John Doe', Combien: 25,pourquoi:'popo',quand:'2mois',concerneQui:'john',pourVous:'popo'},
        
      ]); 
      const [newQuiAPaye, setQuiAPaye] = useState('');
      const [newCombien, setCombien] = useState('');
      const [newPourquoi, setPourquoi] = useState('');
      const [newQuand, setQuand] = useState('');
      const [newConcerneQui, setConcerneQui] = useState('');
      const [newPourVous, setPourVous] = useState('');
     
    
      const addRow = () => {
        const newData = [...data, { QuiApaye: newQuiAPaye,Combien : newCombien ,pourquoi:newPourquoi,quand:newQuand,concerneQui:newConcerneQui,pourVous:newPourVous}];
        setData(newData);
        setQuiAPaye('');
        setCombien('');
        setPourquoi('');
        setQuand('');
        setConcerneQui('');
        setPourVous('');
        
      };
   


    return (

        <div>
            <Header />
                <div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Qui a paye ?</th>
                            <th>Combien ?</th>
                            <th>Pourquoi?</th>
                            <th>Concerne qui ?</th>
                            <th>Quand ?</th>
                            <th>Pour Vous ?</th>
                        </tr>
                        </thead>
                        <tbody>
                        {data.map((item) => (
                            <tr key={''} >
                            <td>{item.QuiAPaye}</td>
                            <td>{item.Combien}</td>
                            <td>{item.pourquoi}</td>
                            <td>{item.concerneQui}</td>
                            <td>{item.quand}</td>
                            <td>{item.pourVous}</td>
                            </tr>
                        ))}
                        </tbody>
                    </table>
                    <form class="d-flex justify-content-center">
                        <label>
                        QuiAPaye:
                        <input type="text" value={newQuiAPaye} onChange={(e) => setQuiAPaye(e.target.value)} />
                        </label>
                        <br />
                        <label>
                        Combien:
                        <input type="number" value={newCombien} onChange={(e) => setCombien(e.target.value)} />
                        </label>
                        <label>
                         Pourquoi:
                        <input type="text" value={newPourquoi} onChange={(e) => setPourquoi(e.target.value)} />
                        </label>
                        <br />
                        <label>
                        Quand:
                        <input type="date" value={newQuand} onChange={(e) => setQuand(e.target.value)} />
                        </label>
                        <label>
                        ConcerneQui:
                        <input type="text" value={newConcerneQui} onChange={(e) => setConcerneQui(e.target.value)} />
                        </label>
                        <br />
                        <label>
                        Pourvous:
                        <input type="text" value={newPourVous} onChange={(e) => setPourVous(e.target.value)} />
                        </label>
                        <br />
                        <button type="button" onClick={addRow}>Add Row</button>
                    </form>
                </div>

           
                
           
        </div>
    );
}

export default InputArray;
