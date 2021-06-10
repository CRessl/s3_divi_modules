// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class S3DM_Products extends Component {

  static slug = 's3dm_initiativen';

  renderLayout(data){
    
    if(data.length > 1){

      return this.renderMultiLayout(data);

    }

    return this.renderSingleLayout(data);
  
  }

  renderSingleLayout(item){

    return (
        <div className="s3dm_initiative uk-grid-match uk-child-width-1-2@m uk-child-width-1-1 uk-grid-collapse" uk-grid="true">
            <div className="s3dm_initiative_content_container uk-flex-first@m" >
                <div className="s3dm_initiative_content uk-padding">
                    <h3 className="s3dm_initiative_content_title">
                        {item.title}
                    </h3>
                    <p>
                        {item.content}
                    </p>
                </div>
            </div>
            <div className="s3dm_initiative_image uk-background-cover uk-flex-first uk-flex-last@m" style={{backgroundImage: 'url('+item.image+')'}}>
               <img src={item.image} className="uk-invisible" alt={item.title} />
            </div>
        </div>
    );

  }

  renderMultiLayout(data){

    let elements = data.map((item, index) => 
        <div className="s3dm_initiative_item" key={index}>

            <div className="s3dm_initiative_image uk-cover-container uk-background-cover" style={{backgroundImage: 'url('+item.image+')'}}>
                <img src={item.image} className="uk-invisible" alt={item.title} />
            </div>
            <div className="s3dm_initiative_content uk-padding uk-text-center" >
                <h4 className="s3dm_initiative_title">{item.title}</h4>
            </div>

        </div>
        );

    return (
        <div className={"s3dm_initiatives_container uk-flex-center uk-child-width-1-"+this.props.columns+"@m uk-child-width-1-1"} uk-grid="true" uk-height-match=".s3dm_initiative_content">
            {elements}
        </div>
    );
    
  }

  render() {
    
    const data = this.props.__productsData;

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

export default S3DM_Products;
