// External Dependencies
import React, { Component } from 'react';

// Internal Dependencies
import './style.css';


class S3DM_EventList extends Component {

  static slug = 's3dm_event_list';

  renderButton(link){

    let show_more = this.props.show_more;

    let button_text = this.props.button_text;

    if(!button_text){
      button_text = 'Mehr...';
    }

    if(show_more === 'on'){
      return (
        <div className="s3dm_event_list_link">
          <a href={link} className="uk-button uk-button-default">{button_text}</a>
        </div>
      );
    }

    return null;


  }

  renderTitle(title){

    return (
      <div className="s3dm_event_list_title"><h4>{title}</h4></div>
    );

  }

  renderDate(date){

    return (

      <div className="s3dm_event_list_date">{date}</div>

    );

  }

  render() {

    let posts;

    if(this.props.__eventData){
      posts = this.props.__eventData;
    }else{ 
      posts = false;  
    }

    let items = {};

    if(posts){
      
      items = posts.map(({title, link, date}, index) => {

        return (
          <div className={"uk-width-1-1 uk-width-1-"+this.props.posts_number+'@m'} key={index}>
            {this.renderDate(date)}
            {this.renderTitle(title)}
            {this.renderButton(link)}
          </div>
        );
      });

    }else{
      items = 'No Posts Found';
    }

    return (
      <div>
        <div className="uk-grid-divider" uk-grid="true">
          {items}
        </div>
      </div>
    );
  }
}

export default S3DM_EventList;
