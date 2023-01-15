import React, { useState , useContext } from "react";
import { Link } from "react-router-dom";
import { Modal, Button, Form } from "react-bootstrap";
import Header from "../component/header";
import { context } from "../context/context";

// Faire des conditions , si cost != "" , afficher en premier la liste des cost (tableau) function RecapCost
// si cost est vide afficher en premier function CreateCost

function AddParticipant(props) {
  const [show, setShow] = useState(false);
  const submit = (event) => {
    event.preventDefault();
  };

  const handleClose = () => setShow(false);
  const handleShow = () => setShow(true);

  return (
    <>
      <p>
        Pour qui était la dépense : <span class="JS-chooseParticipantVisible" >Détails</span>
      </p> 

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
export default function CreateCost() {
  const [show, setShow] = useState(false);

  const { logged, setLogged } = useContext(context);
  console.log("/depense logged", logged)
  console.log("/depense logged.username", logged.username)
  console.log("/depense context", context)

  return (
    <>
      <Header />
      <p className="bg-primary p-2 text-white text-end">
            {/* rendre le prénom de l'user.id */}
            Vous êtes identifié comme <em>{logged.username}</em>
      </p>
      <div className="create-wrapper p-3">
        <form className="p-4">
          <div>
            <div className="row pb-4">
              <label
                for="costNama"
                className="col-2 form-label"
              >
                Nom de la dépense :
              </label>

              <input
                type="text"
                className="col-6" 
                id="costName"
              />

              <select className="custom-select  col mx-5" id="CostType">
                <option selected>type de dépense</option>
                <option>Rentrée d'argent</option>
                <option>Transfert d'argent</option>
              </select>
            </div>
            
            {/* <Link to="/"><span class="text-right">(Plus d'info)</span></Link> */}
          </div>

          <div className="form-group row pb-4">
            <div className="row pb-4">
              <label
                for="who paid"
                className="col-2 form-label"
              >
                Qui a payé :
              </label>
              <select className="custom-select col-2 " id="">
                <option>Deva</option>
                <option>Jessica</option>
                <option>Rayan</option>
              </select>
            </div>

            <div className="row pb-4">
              <label for="date" className="col-2 form-label">
                Date (facultatif) :
              </label>

              <input
                type="date"
                id="date"
                className="col-2 "
              />
            </div>

            <div className="row pb-4">
              <label
                for="amount"
                className="col-2 form-label"
              >
                Montant :
              </label>

              <input
                type="text"
                className="col-2"
                id="amount"
              />
            </div>

            <div className="AddParticipantModal pt-5">
              <AddParticipant show={show} onHide={() => setShow(false)} />
            </div>
          </div>
        </form>
        <div className="p-2 bg-primary mt-auto">
            <Link to="/depense">
                <button type="submit" className="mb-0 text-white btn"><u>Sauvegarder</u></button>
            </Link>
        </div>
      </div>
    </>
  );
}
