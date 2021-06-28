// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class S3DM_WorkGroups extends Component {

  static slug = 's3dm_work_groups';

  renderLayout(data){
    
    if(data.length > 1){

      return this.renderSliderLayout(data);

    }

    return this.renderSingleLayout(data);
  
  }

  renderContact(item){

    let contact =  item.leiter.map((item, index) => 
      <span key={index}>
        <b>Leitung: </b>{item.firstname} {item.lastname}<br />
        <b>E-Mail: </b>{item.email}<br />
        <b>Telefon: </b>{item.phone}<br />
      </span>
    );

    let vorsitz =  item.vorsitz.map((item, index) => 
      <span key={index}>
        <b>Vorsitz: </b>{item.firstname} {item.lastname}{item.company}
      </span>
    );

    return (
      <p>
      {contact}
      {vorsitz}
      </p>
    );


  }

  renderSingleLayout(data){

    let elements = data.map((item, index) => 
      <div className="s3dm_workgroups_item uk-grid-match" uk-grid="true" key={index}>
  
        <div className="uk-width-expand uk-flex-middle uk-flex uk-padding-remove-top uk-padding-remove-bottom uk-padding">
            <div className={this.props.title_size}>
                <h3>{item.title}</h3>
                <p>{item.content}</p>
            </div>
        </div>
        <div className="s3dm_workgroups_slider_item_contact uk-width-auto">
            <div className="contactContainer">
                <h3 className="uk-margin-small s3dm_workgroups_slider_item_contact_title">Kontakt</h3>
                {this.renderContact(item)}
            </div>
        </div>

      </div>
    );

    return elements;

  }

  renderSliderLayout(data){

    let elements = data.map((item, index) => 
      <li className="s3dm_workgroups_slider_item uk-padding uk-padding-remove-left" key={index}>

        <div className="s3dm_workgroups_item uk-flex-center" uk-grid="true">
          
            
            <div className="uk-width-expand@m uk-width-1-1 uk-flex-middle uk-flex uk-padding-remove-top uk-padding-remove-bottom uk-padding">
                <div className={this.props.title_size}>
                    <h3 className="uk-margin-small s3dm_workgroups_slider_item_contact_title">{item.title}</h3>
                    <p>{item.content}</p>
                </div>
            </div>
            <div className="s3dm_workgroups_slider_item_contact uk-width-auto@m">
                <div className="contactContainer">
                    <h3 className="uk-margin-small s3dm_workgroups_slider_item_contact_title">Kontakt</h3>
                    {this.renderContact(item)}
                </div>
            </div>

        </div>

      </li>
    );

    return (
      <div className="s3dm_workgroups_slider" uk-slider>
        <div className="uk-slider-container">
          <ul className="uk-slider-items uk-child-width-1-1">
            {elements}
          </ul>
          <a className="uk-position-center-left-out uk-position-small uk-hidden-hover" href="#prev" uk-slidenav-previous="true" uk-slider-item="previous"> </a>
          <a className="uk-position-center-right-out uk-position-small uk-hidden-hover" href="#next" uk-slidenav-next="true" uk-slider-item="next"> </a>
        </div>
      </div>
    );
    
  }

  render() {
    
    const data = this.props.__workgroupData;
    let items;

    items = 'No Data available';

    if(data){
      
      items = this.renderLayout(data);

    }


    return (
      <div>
        {items}
      </div>
    );
  }
}

export default S3DM_WorkGroups;
