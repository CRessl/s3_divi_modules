// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class S3DM_ContactPerson extends Component {

  static slug = 's3dm_post_contact';
  

  render() {

    return (
    <div className="s3dm_contact_person uk-padding uk-padding-remove-right">
        <img width="300" height="300" src="https://dummyimage.com/300x300/333/fff" className="uk-border-circle" alt="dummy"/>
        <div className="s3dm_contact_person_content">
            <h3 className="s3dm_contact_person_name">Dr. Prof. Mag. Max Mustermann</h3>
            <p className="s3dm_contact_person_position">Musterposition</p>
            <p className="s3dm_contact_person_tel">Tel: 0221 / 123 4567</p>
            <p className="s3dm_contact_person_email">dummy@email.com</p>
        </div>

    </div>
    );
  }
}

export default S3DM_ContactPerson;
