// External Dependencies
import React, { Component } from 'react';

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

  showArrows(){

    if(this.props.show_arrows === 'on'){
      return (
        <div>
          <a className="uk-position-center-left uk-position-small uk-hidden-hover uk-light" href="#prev" uk-slidenav-previous="true" uk-slideshow-item="previous"> </a>
          <a className="uk-position-center-right uk-position-small uk-hidden-hover uk-light" href="#next" uk-slidenav-next="true" uk-slideshow-item="next"> </a>
        </div>
      );
    }
    return null;

  }

  sliderOptions(){

    const animation = this.props.slider_animation;
    const prop_duration = this.props.slider_duration;
    const autoplay = this.props.slider_autoplay;
    const interval = prop_duration * 1000;
    let optionsString;

    if(autoplay === 'on'){

      optionsString = "animation:" + animation + "; autoplay: true; min-height: 600; max-height: 800; pause-on-hover:true; autoplay-interval:"+interval+";";

    }else{
      optionsString = "animation:" + animation + "; autoplay: false; min-height: 600; max-height: 800; pause-on-hover:true;";
    }

    return optionsString;

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

  render() {

    let posts;
    let moduleID;

    if(this.props.__postData){
      posts = this.props.__postData.posts;
      moduleID = this.props.__postData.moduleID;
    }else{ 
      posts = false;      
    }

    const textColor = this.props.module_text_color;

    let items = {}

    if(posts){
      
      items = posts.map(({title, excerpt, link, categories, date, imageSrc, author}, index) => {

        return (
          <li className="uk-background-cover" style={{backgroundImage: `url(${imageSrc})`}} key={index}>   
            {this.linkAll(link)}
            <img uk-cover="" src={imageSrc} alt={title} />
            <div className="s3dm_extended_post_slider_content uk-position-center-left" style={{zIndex: 2, width: '100%'}}>

              <div className="et_pb_row">
                {this.showDate(date, textColor)}
                <div className="s3dm_extended_post_slider_categories uk-grid-small uk-margin-top" uk-grid="true" dangerouslySetInnerHTML={{__html: categories}}></div>
                {this.renderText(title, excerpt, textColor)}
                {this.showButton(link)}
              </div>

            </div>
            <div className="uk-position-cover" style={{opacity: 0.5, background: '#000', zIndex: 1}}></div>
          </li>
        );
      });
    }else{
      items = 'No Posts Found';
    }

    

    return (
      <div id={moduleID}>
        <div className="s3dm_extended_post_slider_slideshow_container" uk-slideshow={this.sliderOptions()}>
          <div className="uk-position-relative uk-visible-toggle uk-light">
            <ul className="uk-slideshow-items">
              {items}
            </ul>
            {this.showArrows()}
          </div>
        </div>
      </div>
    );
  }
}

export default S3DM_ExtendedPostSlider;
