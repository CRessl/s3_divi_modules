// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class S3DM_ProductInfo extends Component {

  static slug = 's3dm_product_info';


  renderBubble(price, member_price){

    if((member_price === 0 || member_price === '0') && (price !== 0 || price !== '0')){

      return(
        <div className="bubble uk-flex uk-flex-middle">
          <div>
            <p className="uk-margin-small-bottom">Für EHI-Mitglieder kostenlos</p>
          </div>
        </div>
      );
    }

    if((member_price === 0 || member_price === '0') && (price === 0 || price === '0')){
      
      return (
        <div className="bubble uk-flex uk-flex-middle">
          <div>
            <p className="uk-margin-small-bottom">kostenloser Download</p>
          </div>
        </div>
      );
    
    }


  }

  renderImage(packshotUrl, title){

    return (
      <img src={packshotUrl} alt={title} />
    );

  }
  
  renderTitle(title, subtitle){

    if(title && subtitle){

      return (
        <div>
          <h3 className={this.props.title_size}>{title}</h3>
          <h3 className={this.props.subtitle_size}>{subtitle}</h3>
        </div>
      )

    }

    if(title && !subtitle){

      return (
        <div>
          <h3 className={this.props.title_size}>{title}</h3>
        </div>
      )

    }

    if(!title && subtitle){

      return (
        <div>
          <h3 className={this.props.subtitle_size}>{subtitle}</h3>
        </div>
      )

    }

  }

  renderPrice(price){

    if(price){

      return (
        <div>
          <span className="price">{price} €</span> zzgl. MwSt.
        </div>
      )

    }

  }
  renderMemberPrice(member_price){

    if(member_price || member_price === 0){

      return (
        <div>
            <span className="member_price">Preis für Mitglieder: {member_price} € zzgl. MwSt.</span>
        </div>
      )

    }

  }

  renderButton(){

    if(this.props.show_order_button){

      return(
        <div className="s3dm_product_info_button_container uk-margin-medium-top">
            <a className="ehi-color-btn s3dm_product_info_button uk-display-inline-block" href={this.props.button_link}>
                {this.props.button_text}
            </a>
        </div>
      )


    }


  }

  render() {
    
    return (
      <div className="uk-child-width-1-2@m uk-child-width-1-1" uk-grid="true">
        <div className="s3dm_product_info_image_container uk-position-relative uk-text-center">
          {this.renderBubble('200', '0')}
          {this.renderImage('https://via.placeholder.com/350', 'Product Title')}
        </div>
        <div className="s3dm_product_info_content_container">
          <div className="s3dm_product_info_title_container ehi-h1">
            {this.renderTitle('Product Title', 'Product Subtitle')}
          </div>
          <div className="s3dm_product_info_detail uk-margin-small-top">
            <ul className="uk-list">
           
              <li><b>Autor:in:</b> Max Mustermann, Manuela Mustermann</li> 
              <li><b>Produktnummer:</b> VER12345</li> 
              <li><b>Seitenanzahl:</b> 5</li> 
              <li><b>Erscheinungsjahr:</b> 2021</li> 
              <li><b>ISBN:</b> 123-4-56789-101-11</li> 
              <li><b>Format</b> PDF-Download</li> 
                
            </ul>
          </div>
          <div className="s3dm_product_info_price_container uk-margin-medium-top">
            {this.renderPrice('200')}
            {this.renderMemberPrice('0')}
          </div>
          {this.renderButton()}
        </div>
      </div>
    );
  }
}

export default S3DM_ProductInfo;
