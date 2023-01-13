import React, { useState } from "react";
import { Link } from "react-router-dom";
import { Modal, Button, Form } from "react-bootstrap";
import Header from "../component/header";
import CreateCost from "../component/createCost";

function AddParticipantModal(props) {
  const [show, setShow] = useState(false);
  const submit = (event) => {
    event.preventDefault();
  };

  const handleClose = () => setShow(false);
  const handleShow = () => setShow(true);

  return (
    <>
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
export default function Cost() {
  const [show, setShow] = useState(false);

  return (
    <>
      <Header />
      <form className="card-body p-5 card w-50 p-4">
        <div>
          <div className="d-flex">
            <label
              for="what"
              className="col-sm-2 col-form-label col-form-label-sm"
            >
              Quoi :
            </label>

            <input
              type="text"
              className="form-control form-control-sm" //
              id="what"
            />

            <select className="custom-select" id="">
              <option selected>Dépense</option>
              <option>Rentrée d'argent</option>
              <option>Transfert d'argent</option>
            </select>
          </div>

          <Link to="/">(Plus d'info)</Link>
        </div>

        <div className="form-group row p-2">
          <div className="d-flex">
            <label
              for="who paid"
              className="col-sm-2 col-form-label col-form-label-sm"
            >
              Qui a payé :
            </label>
            <select className="custom-select" id="">
              <option>Deva</option>
              <option>Jessica</option>
              <option>Rayan</option>
            </select>
          </div>

          <div className="d-flex">
            <label for="date" className="col-sm-2 col-form-label-sm">
              Date (facultatif) :
            </label>

            <input
              type="date"
              id="date"
              className="form-control form-control-sm w-25"
            />
          </div>

          <div className="d-flex">
            <label
              for="amount"
              className="col-sm-2 col-form-label col-form-label-sm"
            >
              Montant :
            </label>

            <input
              type="text"
              className="form-control form-control-sm w-25"
              id="amount"
            />
          </div>

          <div>
            <p>
              Pour qui était la dépense : <Link to="/détails">Détails</Link>
            </p>
          </div>

          <div className="solid">
            <p></p>
          </div>
          <div className="AddParticipantModal">
            <AddParticipantModal show={show} onHide={() => setShow(false)} />
          </div>
          <div className="solid">
            <p></p>
          </div>
          <div className="solid">
            <p></p>
          </div>
        </div>
      </form>
    </>
  );
}
