// External Dependencies
import React, { Component } from 'react';
import $ from 'jquery';
import UIkit from '../../../assets/js/uikit.min.js';
import gsap from '../../../assets/js/gsap.min.js';

//Components (Nav and Content)
import PostTabSliderContent from './PostTabSliderContent';
import PostTabSliderNav from './PostTabSliderNav';


// Internal Dependencies
import './style.css';


class S3DM_PostTabSlider extends Component {

  static slug = 's3dm_post_tab_slider';

  componentDidMount(){

    UIkit.switcher(document.querySelector('.s3dm_switcher'), {
      animation: false,
      connect: '.s3dm_tab_contents'
    });

    let $element = document.querySelector('.s3dm_tab_contents');

    $(document).on('shown', $element, function(event){
					
      var activeContentElement = event.target;

      var text = $(activeContentElement).find('.s3dm_grid_content');
      var image = $(activeContentElement).find('.s3dm_grid_image');

      gsap.to(text, {x:0, opacity:1, duration: 0.5, delay:0.3});
      gsap.to(image, {x: 0,duration: 0.5,opacity: 1,delay: 0.3});

    });

    $(document).on('beforehide', $element,  function(event){
      
      var activeContentElement = event.target;

      var text = $(activeContentElement).find('.s3dm_grid_content');
      var image = $(activeContentElement).find('.s3dm_grid_image');

      gsap.to(text, {x:-100, opacity:0, duration: 0.5, delay:0.3});
      gsap.to(image, {x: 100,duration: 0.5,opacity: 0,delay: 0.3});

    });


  }

  render() {

    let posts;

    if(this.props.__posts){
      posts = this.props.__posts.postData;
    }else{ 
      posts = false;
    }

    let componentID = 's3dm_switcher_all_container_'+posts.componentID;

    return (
      <div id={componentID}>
        <div className="s3dm-tab-slider-content-container uk-margin-large-bottom">
          <PostTabSliderContent postData={posts} />
        </div>
        <div className="s3dm-tab-slider-tab-nav-container">
          <PostTabSliderNav postData={posts} />
        </div>
      </div>
    );
  }
}

export default S3DM_PostTabSlider;
