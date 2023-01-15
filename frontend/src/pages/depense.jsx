import React, { useState , useContext } from "react";
import { Link } from "react-router-dom";
import { Modal, Button, Form } from "react-bootstrap";
import Header from "../component/header";
import { context } from "../context/context";
import axios from "axios";

// Faire des conditions , si cost != "" , afficher en premier la liste des cost (tableau) function RecapCost
// si cost est vide afficher en premier function CreateCost

function AddParticipant(props) {
  const [show, setShow] = useState(false);
  const {participants, setParticipants} = useContext(context);
  console.log("/depense participants:", participants)
  const submit = (event) => {
    event.preventDefault();
  };

  const handleClose = () => setShow(false);
  const handleShow = () => setShow(true);

  return (
    <>
      <p>
        Pour qui était la dépense : <span className="JS-chooseParticipantVisible" >Détails</span>
      </p> 

      {participants.map((participant, index) => (
                  <div key={index} className="d-flex flex-row align-items-center create-tenant__info">
                      <p className="p-2 border border-secondary rounded mb-0 w-25">{participant}</p>
                  </div>
                ))}

     <Button variant="mt-4 pt-4 text-primary" onClick={handleShow}>
        <u>Ajouter un participant</u>
      </Button>

      <Modal show={show} onHide={handleClose} centered>
        <Modal.Header closeButton>
          <Modal.Title>Ajouter un participant</Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <Form onSubmit={submit} method="POST" action="">
            <Form.Group className="mb-3" controlId="exampleForm.ControlInput1">
              <Form.Label>E-mail</Form.Label>
              <Form.Control type="email" />
            </Form.Group>
          </Form>
        </Modal.Body>
        <Modal.Footer>
          <Button variant="secondary" onClick={handleClose}>
            Ok,
          </Button>
          <Button type="submit" variant="primary" onClick={handleClose}>
            Annuler
          </Button>
        </Modal.Footer>
      </Modal>
     
    </>
  );
}
export default function CreateCost(props) {
  const [show, setShow] = useState(false);
  const {participants, setParticipants} = useContext(context);

  const { logged, setLogged } = useContext(context);
  console.log("/depense logged.username", logged.username)

  //gestion tableau des dépenses
  const [showModal, setShowModal] = useState(false);
  const handleOpenModal = () => {
    setShowModal(true);
  }
  const handleCloseModal = () => {
    setShowModal(false);
  }
  const [dataCost, setDataCost] = useState([{ 
    QuiAPaye:"", 
    Combien:"" ,
    pourquoi:"", 
    costType:"", 
    quand:"", 
    concerneQui:"" , 
    pourVous:""} ]);
  
  const [selectedCostType, setselectedCostType] = useState('');
  const [newQuiAPaye, setQuiAPaye] = useState('');
  const [newCombien, setCombien] = useState('');
  const [newPourquoi, setPourquoi] = useState('');
  const [newQuand, setQuand] = useState('');
  const [newConcerneQui, setConcerneQui] = useState('');
  const [newPourVous, setPourVous] = useState(''); 


  const submit = (event) => {
    
    event.preventDefault();
    setDataCost(
      [...dataCost, { 
        [event.target.name]: event.target.value 
      }]);
      console.log('submit')
      const data = {
        data: {
          type: "Cost",
          attributes: {
            credit: 0,
            debit: 0,
            designation : newPourquoi,
            cost_type: selectedCostType,
            username: newQuiAPaye,
            date: newQuand,
          },
        },
      };
      console.log(data);
      axios({
        method: "post",
        url: "http://localhost:5656/costs",
        data: JSON.stringify(data),
      })
        .then(function (response) {
          console.log(response);
      })
      .catch(error => {
        console.log(error);
      });

    // setDataCost('');
    // setQuiAPaye('');
    // setCombien('');
    // setPourquoi('');
    // setQuand('');
    // setConcerneQui('');
    // setPourVous('');
    // setselectedCostType('');
  };
 console.log('dataCost', dataCost)

  return (
    <>
      <Header />
      <p className="bg-primary p-2 text-white text-end">
            {/* rendre le prénom de l'user.id */}
            Vous êtes identifié comme <em>{logged.username}</em>
      </p>

      {showModal && (
            <div>
            <div className="modal" tabIndex="-1" role="dialog">Contenu du modal</div>
            <button  className='btn btn-primary' onClick={handleCloseModal}>Fermer le tableau</button>
            <table className="table">
                <thead>
                <tr>
                    <th>Qui a paye ?</th>
                    <th>Combien ?</th>
                    <th>Pourquoi?</th>
                    <th>Quel type?</th>
                    <th>Concerne qui ?</th>
                    <th>Quand ?</th>
                    <th>Pour Vous ?</th>
                </tr>
                
                </thead>
            
                <tbody>
                {dataCost.map((item, QuiAPaye) => (
                    <tr key={QuiAPaye} >
                    <td>{item.QuiAPaye}</td>
                    <td>{item.Combien}</td>
                    <td>{item.pourquoi}</td>
                    <th>{item.costType}</th>
                    <td>{item.concerneQui}</td>
                    <td>{item.quand}</td>
                    <td>{item.pourVous}</td>
                    <td><button>supprimer</button></td>
                    </tr>
                ))}
                </tbody>
            </table>
            </div>
            )}

      <div className="create-wrapper p-3">
        <form className="p-4" method="POST">
          <div>
            <div className="row pb-4">
              <label
                htmlFor="costName"
                className="col-2 form-label"
              >
                Nom de la dépense :
              </label>

              <input
                type="text"
                className="col-6" 
                id="costName"
                name="pourquoi"
                value={dataCost.pourquoi}
              />

              <select className="custom-select  col mx-5" 
                id="CostType" 
                name="costType"
                value={dataCost.coastType} 
              >

                <option value="Dépense">Dépense</option>
                <option value="Rentrée d'argent">Rentrée d'argent</option>
                <option value="Transfert d'argent">Transfert d'argent</option>
              </select>
            </div>

          </div>

          <div className="form-group row pb-4">
            <div className="row pb-4">
              <label
                htmlFor="who paid"
                className="col-2 form-label"
              >
                Qui a payé :
              </label>
              <select className="custom-select col-2 " 
                id="" 
                name="QuiAPaye"
                value={dataCost.QuiAPaye} 
                >
                  <option value={ logged.username }>{logged.username}</option>
                  {participants.map((participant, index) => (
                  <option value={ participant }>{ participant }</option>
                ))}
              </select>
            </div>

            <div className="row pb-4">
              <label htmlFor="date" className="col-2 form-label">
                Date (facultatif) :
              </label>

              <input
                type="date"
                id="date"
                className="col-2 "
                name="quand"
                value={dataCost.quand}
              />
            </div>

            <div className="row pb-4">
              <label
                htmlFor="amount"
                className="col-2 form-label"
              >
                Montant :
              </label>

              <input
                type="text"
                className="col-2"
                id="amount"
                name="Combien"
                value={dataCost.Combien} 
              />
            </div>

            <div className="AddParticipantModal pt-5">
              <AddParticipant show={show} onHide={() => setShow(false)} />
            </div>
          </div>
       
          <div className="p-2 bg-primary mt-auto">
              <Link to="/depense">
                  <button type="submit" className="mb-0 text-white btn" onClick={(e) => {handleOpenModal(); submit(e)}}><u>Sauvegarder</u></button>
                  <button className="btn mb-0 text-white"type="button" onClick={handleOpenModal}><u>Voir les depenses</u></button>
              </Link>
          </div>
        </form>

      </div>

      
    </>
  );
}
