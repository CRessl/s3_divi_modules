// External Dependencies
import React, { Component } from 'react';
import { Splide, SplideSlide } from '@splidejs/react-splide';
import '@splidejs/splide/dist/css/themes/splide-default.min.css';

// Internal Dependencies
import './style.css';


class S3DM_ExtendedPostSlider extends Component {

  static slug = 's3dm_extended_post_slider';

  showButton(link){
    
    if(this.props.show_more === 'on'){
      return (
      <div className="s3dm_extended_post_slider_button">
        <a className="uk-button uk-button-primary s3dm_extended_post_slider_button" href={link}>{this.props.button_text}</a>
      </div>
      );
    }

    return null;

  }

  showDate(date, color){
    let textColor;

    if(color){
      textColor = color;
    }else{
      textColor = '#000';
    }

    if(this.props.show_date === 'on'){
      return (
        <div className="s3dm_extended_post_slider_date" style={{color: textColor}}>{date}</div>
      );
    }
    return null
  }

  linkAll(link){

    if(this.props.show_more === 'off'){
      return (
        <a href={link} className="uk-position-cover" style={{zIndex: 10}}> </a>
      );
    }

    return null;

  }

  renderText(title, excerpt, color){

    let textColor;

    if(color){
      textColor = color;
    }else{
      textColor = '#000';
    }

    if(title && excerpt){
      return (
        <div>
          <h1 style={{color: textColor}}>{title}</h1>
          <p className="uk-light uk-margin-bottom" style={{color: textColor}}>{excerpt}</p>
        </div>
      );
    }else if(title && !excerpt){
      return (
        <div>
          <h1 style={{color: textColor}}>{title}</h1>
        </div>
      );
    }

    return null;

  }

  showCategories(categories){
    
    if(this.props.show_categories === 'on'){
      return (
        <div className="s3dm_extended_post_slider_categories uk-grid-small uk-margin-top uk-grid" dangerouslySetInnerHTML={{__html: categories}} />
      );
    }else{
      return '';
    }
    


  }

  mobileContent(title, excerpt, link, categories, date, color){
    
    return (
      <div className="s3dm_extended_post_slider_mobile_content uk-hidden@s">
        <div className="et_pb_row">

          {this.showDate(date)}
          {this.showCategories(categories)}
          {this.renderText(title, excerpt, color)}
          {this.showButton(link)}

          </div>
      </div>
    )
  
  
  }

  desktopContent(title, excerpt, link, categories, date, color){
    
    
    return(
      <div className="s3dm_extended_post_slider_content uk-visible@s" style={{width: '100%'}}>
        <div className="et_pb_row" style={{padding: "14% 0"}}>
          {this.showDate(date)}
          {this.showCategories(categories)}
          {this.renderText(title, excerpt, color)}
          {this.showButton(link)}
        </div>
      </div>
    )

  }

  render() {

    let posts;

    if(this.props.__postData){
      posts = this.props.__postData.posts;
    }else{ 
      posts = false;      
    }

    const textColor = this.props.module_text_color;

    let items = {}

    if(posts){
      
      items = posts.map(({title, excerpt, link, categories, date, imageSrc, author}, index) => {

        return (
          <SplideSlide key={index} className="s3dm_extended_post_slider_item" >
            <div className="uk-background-cover" style={{backgroundImage: `url(${imageSrc})`}}>
              {this.linkAll(link)}
              <img className="uk-hidden@s" src={imageSrc} alt={title} />
              {this.mobileContent(title, excerpt, link, categories, date, textColor)}
              {this.desktopContent(title, excerpt, link, categories, date, textColor)}
              <div className="uk-position-cover uk-visible@s s3dm_slider_dark_bg_overlay" />
            </div>
          </SplideSlide>
        );
      });
    }else{
      items = 'No Posts Found';
    }

    const settings = {
      rewind : true,
      type: 'fade',
      waitForTransition: true,
      speed: 1000,
      autoplay: true,
      interval: 5000,
      perPage: 1,
      padding: 0,
      gap: 0,
    }
    

    return (
      <Splide options={settings}>
          {items}
      </Splide>
    );
  }
}

export default S3DM_ExtendedPostSlider;
