import React, { useState , useContext } from "react";
import { useNavigate } from "react-router-dom";
import { Modal, Button, Form } from "react-bootstrap";
import Header from "../component/header";
import { context } from "../context/context";
import axios from "axios";


// Faire des conditions , si cost != "" , afficher en premier la liste des cost (tableau) function RecapCost
// si cost est vide afficher en premier function CreateCost

function AddParticipant(props) {
  const [show, setShow] = useState(false);
  const {participants, setParticipants} = useContext(context);
  //console.log("/depense participants:", participants)
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
  const navigate = useNavigate();
  const [show, setShow] = useState(false);
  const {participants, setParticipants} = useContext(context);

  const { logged, setLogged } = useContext(context);


  //gestion tableau des dépenses
  const [showModal, setShowModal] = useState(false);
  const handleOpenModal = () => {
    setShowModal(true);
  }
  const handleCloseModal = () => {
    setShowModal(false);
  }
  const handleRemove = QuiAPaye => {
    const newDataCost = 
      [...dataCost];
      newDataCost.splice(QuiAPaye, 1);
      setDataCost(newDataCost)
    };

  const [dataCost, setDataCost] = useState([]);
  const [costType, setselectedCostType] = useState("Depense");
  const [QuiAPaye, setQuiAPaye] = useState(`{ logged.username }`);
  const [Combien, setCombien] = useState();
  const [pourquoi, setPourquoi] = useState();
  const [quand, setQuand] = useState();
  const [concerneQui, setConcerneQui] = useState();
  const [pourVous, setPourVous] = useState(); 



  const submit = (event) => {
    
    event.preventDefault();
    setDataCost([...dataCost, { QuiAPaye, Combien, pourquoi, costType, quand, concerneQui, pourVous }]);
      const data = {
        data: {
          type: "Cost",
          attributes: {
            credit: Combien,
            debit: concerneQui,
            designation : pourquoi,
            cost_type: costType,
            username: QuiAPaye,
            date: quand,
          },
        },
      };
      //console.log(data);
      axios({
        method: "post",
        url: "http://localhost:5656/costs",
        data: JSON.stringify(data),
      })
        .then(function (response) {
          //console.log('response', response);
          navigate("/depense");
      })
      .catch(error => {
        //console.log(error);
      });
     
    setDataCost('');
    setQuiAPaye('');
    setCombien('');
    setPourquoi('');
    setQuand('');
    setConcerneQui('');
    setPourVous('');
    setselectedCostType('');
  };
  //console.log('dataCost', dataCost)

  return (
    <>
      <Header />
      <p className="bg-primary p-2 text-white text-end">
            {/* rendre le prénom de l'user.id */}
            Vous êtes identifié comme <em>{logged.username}</em>
      </p>

      {showModal && (
            <div>
            <table className="table p-4">
                <thead>
                <tr>
                    <th>Qui a paye ?</th>
                    <th>Combien ?</th>
                    <th>Pourquoi?</th>
                    <th>Quel type?</th>
                    <th>Concerne qui ?</th>
                    <th>Quand ?</th>
                    <th>Ma part ?</th>
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
                    <td><button className="btn text-primary" onClick={() => handleRemove(item)}><u>Supprimer</u></button></td>

                    </tr>
                ))}
                </tbody>
            </table>
            <button  className='btn btn-primary text-right' onClick={handleCloseModal}>Fermer le tableau</button>
            </div>
            )}

      <div className="create-wrapper p-3">
        <form className="p-4" onSubmit={submit} method="POST" action="">
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
                value={pourquoi}
                onChange={(e) => {
                  setPourquoi(e.target.value);
                }}
              />

              <select className="custom-select col mx-5" 
                id="CostType" 
                name="costType"
                value={costType} 
                onChange={(e) => {
                  setselectedCostType(e.target.value);
                }}
              >
                <option value="Depense">Dépense</option>
                <option value="Remboursement">Remboursement</option>
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
                value={QuiAPaye}
                onChange={(e) => {
                  setQuiAPaye(e.target.value);
                }} 
                >
                  <option value="quiPaye">Choisir qui paye</option>
                  <option value={logged.username}>{logged.username}</option>
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
                value={quand}
                onChange={(e) => {
                  setQuand(e.target.value);
                }}
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
                value={Combien}
                onChange={(e) => {
                  setCombien(e.target.value);
                }} 
              />
            </div>

            <div className="AddParticipantModal pt-5">
              <AddParticipant show={show} onHide={() => setShow(false)} />
            </div>
          </div>
       
          <div className="p-2 bg-primary mt-auto">
                  <button type="submit" className="mb-0 text-white btn" onClick={(e) => handleOpenModal()}><u>Sauvegarder</u></button>
                  <button className="btn mb-0 text-white"type="button" onClick={handleOpenModal}><u>Voir les depenses</u></button>
          </div>
        </form>
      </div>
    </>
  );
}
