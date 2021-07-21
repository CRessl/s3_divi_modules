// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class S3DM_Products extends Component {

  static slug = 's3dm_products';


  renderBubble(member_price, price){

    if(this.props.show_bubble === 'on'){
      if((member_price === 0 || member_price === '0') && (price !== 0 || price !== '0')){

        return(
          <div className="bubble uk-flex uk-flex-middle">
              <p className="uk-margin-small-bottom">Für EHI-Mitglieder kostenlos</p>
          </div>
        );
      }
  
      if((member_price === 0 || member_price === '0') && (price === 0 || price === '0')){
        
        return (
          <div className="bubble uk-flex uk-flex-middle">
              <p className="uk-margin-small-bottom">kostenloser Download</p>  
          </div>
        );
      
      }
    }
   

  
    

  }

  renderImage(packshot, alt, member_price, price){


    if(this.props.show_image === 'on'){
      return (
        <div className="s3dm_product_list_grid_product_image uk-position-relative">
          {this.renderBubble(member_price, price)}
          <img className="s3dm_post_list_product_image" src={packshot} alt={alt} />
        </div>
      );
    }

  }

  renderTitle(title, subtitle){

    if(title && !subtitle){

      return (
        <div className="s3dm_product_list_title">
          <h2>
            {title}
          </h2>
        </div>
      );


    }

    if(!title && subtitle){

      return (
        <div className="s3dm_product_list_title">
          <h3>
            {subtitle}
          </h3>
        </div>
      );
      
    }

    if(title && subtitle && this.props.show_subtitle === 'on'){

      return (
        <div className="s3dm_product_list_title">
          <h2>
            {title}
          </h2>
          <h3>
            {subtitle}
          </h3>
        </div>
      );
      
    }

    if(title && subtitle && this.props.show_subtitle === 'off'){

      return (
        <div className="s3dm_product_list_title">
          <h2>
            {title}
          </h2>
        </div>
      );
      
    }



  }

  renderTags(tags){

    let tagNames = tags.map((tag, index) => 
      <div className="tag" key={index}>
        {tag.name}
      </div>
    );

    if(tags){
      return (
        <div className="s3dm_product_list_tags">
          {tagNames}
        </div>
      );
    }
    


  }

  renderTagsAndDate(tags, date){

    if(this.props.show_meta === 'on'){

      if(this.props.show_date === 'on' && this.props.show_tags === 'on'){

        return (
          <div>
            <div className="s3dm_products_date">
              <span>
                {date}
              </span>
            </div>
            {this.renderTags(tags)}
          </div>
        );


      }

      if(this.props.show_date === 'on' && this.props.show_tags === 'off'){

        return (
          <div>
            <div className="s3dm_products_date">
              <span>
                {date}
              </span>
            </div>
          </div>
        );


      }

      if(this.props.show_date === 'on' && this.props.show_tags === 'off'){

        return (
          <div>
            {this.renderTags(tags)}
          </div>
        );


      }

    }

  }
  renderFormatAndMaxpages(format, max_pages){

    if(this.props.show_page_format === 'on'){

      if(format && max_pages){

        return(
          <div className="s3dm_product_list_product_format_page_container uk-margin-small-bottom">
            <p><b>{format}, {max_pages} Seiten</b></p>
          </div>
        );
  
      }
  
      if(!format && max_pages){
  
        return(
          <div className="s3dm_product_list_product_format_page_container uk-margin-small-bottom">
            <p><b>{max_pages} Seiten</b></p>
          </div>
        );
  
      }
  
      if(format && !max_pages){
  
        return(
          <div className="s3dm_product_list_product_format_page_container uk-margin-small-bottom">
            <p><b>{format}</b></p>
          </div>
        );
  
      }


    }

  }

  renderPrice(price, member_price){



    if(this.props.show_price === 'on'){
      if(price && member_price){
        return (
          <div>
            <div className="s3dm_product_list_product_price_container">
                <p><span className="price">{price} €</span> zzgl. MwSt. </p>
            </div>
            <div className="s3dm_product_list_product_memberprice_container">
                <p>Preis für Mitglieder: {member_price} € zzgl. MwSt.</p>
            </div>
          </div>
        );  
      }

      if(price && !member_price){
        return (
          <div>
            <div className="s3dm_product_list_product_price_container">
                <p><span className="price">{price} €</span> zzgl. MwSt. </p>
            </div>
          </div>
        );  
      }

      if(!price && member_price){
        return (
          <div>
            <div className="s3dm_product_list_product_memberprice_container">
                <p>Preis für Mitglieder: {member_price} € zzgl. MwSt.</p>
            </div>
          </div>
        );  
      }
      
    }

  }
  renderExcerpt(excerpt, permalink){

    if(this.props.show_excerpt === 'on'){

      if(this.props.show_link === 'on'){

        return(
          <div className="s3dm_product_list_excerpt uk-margin-medium-bottom">
              <p className="uk-padding-remove">{excerpt}</p>
              <p className="uk-margin-remove">
                  <a className="uk-text-uppercase" href={permalink}>
                     {this.props.linktext}
                  </a>
              </p> 
          </div>
        );


      }

      if(this.props.show_link === 'off'){

        return(
          <div className="s3dm_product_list_excerpt uk-margin-medium-bottom">
              <p className="uk-padding-remove">{excerpt}</p>
          </div>
        );

      }


    }

  }

  render() {
    
    const productsData = this.props.__productsData;
    let products;
    console.log(productsData);
    if(!productsData){
        products = 'Keine Produkte verfügbar';
    }

    if(productsData){


      products = productsData.map(({title, subtitle, packshot, tags, excerpt, date, permalink, price, member_price, format, max_pages}, index) => {
          return (
            <li className="s3dm_products_grid_item s3dm_product_list_product_container">
              <div className="uk-card-default">
                {this.renderImage(packshot, title, member_price, price)}
                <div className="uk-card-body uk-position-relative">  
                  <a href={permalink} className="uk-position-cover"> </a>
                  {this.renderTagsAndDate(tags, date)}
                  {this.renderTitle(title, subtitle)}
                  {this.renderFormatAndMaxpages(format, max_pages)}
                  {this.renderExcerpt(excerpt, permalink)}
                  {this.renderPrice(price, member_price)}
                </div>
              </div>
            </li>
          );
      });


    }


    return (
      <div className="s3dm_products_slider_container" uk-slider="finite:true;">
        <div class="uk-position-relative">
          <div class="uk-slider-container">
            <ul className={"uk-slider-items uk-child-width-1-1 uk-child-width-1-2@m uk-child-width-1-"+this.props.columns+"@l"} uk-height-match="target: .s3dm_products_grid_item .uk-card-body" uk-grid="true">
              {products}
            </ul>
          </div>
          <a class="uk-position-center-left-out" href="#prev" uk-slider-item="previous"> </a>
          <a class="uk-position-center-right-out" href="#next" uk-slider-item="next"> </a>
        </div>
      </div>
    );
  }
}

export default S3DM_Products;
