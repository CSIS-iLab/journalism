/**
 * BLOCK: Default Block
 *
 * This block was meant to be duplicated.
 * It serves as the starting point for new blocks. 😀
 */

/**
 * External dependencies
 */
import classnames from "classnames"; // Import NPM libraries here.

/**
 * WordPress dependencies
 */
const { InspectorControls, registerBlockType, RichText } = wp.blocks;

/**
 * Internal dependencies
 */
import "./style.scss";

// Import all of our Background Options requirements.
import BackgroundOptions, {
  BackgroundOptionsAttributes,
  BackgroundOptionsClasses,
  BackgroundOptionsInlineStyles,
  BackgroundOptionsVideoOutput
} from "../../components/background-options";

// Import all of our Text Options requirements.
import TextOptions, {
  TextOptionsAttributes,
  TextOptionsInlineStyles
} from "../../components/text-options";

// Import all of our Other Options requirements.
import OtherOptions, {
  OtherOptionsAttributes,
  OtherOptionsClasses
} from "../../components/other-options";

/**
 * Register block
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
export default registerBlockType("wds/default", {
  // Namespaced with 'wds/', lowercase, hyphenated.
  // Localize title using wp.i18n.__()
  title: __("WDS Default Block: Duplicate Me"),
  // Description: Write a quick description.
  description: __("Optional description."),
  // Category options: common, formatting, layout, widgets, embed.
  category: "common",
  // Can use a Dashicon (see https://developer.wordpress.org/resource/dashicons/) or an imported SVG.
  icon: "sos",
  // Limit to 3 keywords/phrases. Users will see your block when they search using these keywords.
  keywords: [__("Options"), __("Editable"), __("Multiline")],
  // Set for each piece of dynamic data used in your block.
  // https://wordpress.org/gutenberg/handbook/block-api/attributes/
  attributes: {
    message: {
      type: "array",
      source: "children",
      selector: ".content-block"
    },
    ...BackgroundOptionsAttributes,
    ...TextOptionsAttributes,
    ...OtherOptionsAttributes
  },
  // Determines what is displayed in the editor.
  // https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/#edit
  edit: props => {
    // Event handler to update the value of the content when changed in editor.
    const setMessageAttribute = value => {
      props.setAttributes({ message: value });
    };
    // Return the markup displayed in the editor, including a core Editable field.
    return [
      !!props.focus && (
        <InspectorControls key="inspector">
          {BackgroundOptions(props)}
          {TextOptions(props)}
          {OtherOptions(props)}
        </InspectorControls>
      ),
      <section
        key="editable-content-example-block-with-options"
        className={classnames(
          props.className,
          ...BackgroundOptionsClasses(props),
          ...OtherOptionsClasses(props)
        )}
        style={{
          ...BackgroundOptionsInlineStyles(props),
          ...TextOptionsInlineStyles(props)
        }}
      >
        {BackgroundOptionsVideoOutput(props)}

        <header className="content-block-header">
          <h2
            style={{
              color: props.attributes.textColor
                ? props.attributes.textColor
                : null
            }}
          >
            {__("WDS Default Block")}
          </h2>
        </header>

        <RichText
          tagName="div"
          multiline="p"
          className="content-block"
          placeholder={__(
            'To customize this block, click on "Show Advanced Settings"'
          )}
          onChange={setMessageAttribute}
          value={props.attributes.message}
          focus={props.focus}
          onFocus={props.setFocus}
        />
      </section>
    ];
  },
  // Determines what is displayed on the front-end.
  // https://wordpress.org/gutenberg/handbook/block-api/block-edit-save/#save
  //
  // For dynamic blocks, you can return null here and define a render callback function in PHP.
  // https://wordpress.org/gutenberg/handbook/blocks/creating-dynamic-blocks/
  save: props => {
    return (
      <section
        className={classnames(
          props.className,
          ...BackgroundOptionsClasses(props),
          ...OtherOptionsClasses(props)
        )}
        style={{
          ...BackgroundOptionsInlineStyles(props),
          ...TextOptionsInlineStyles(props)
        }}
      >
        {BackgroundOptionsVideoOutput(props)}

        <header className="content-block-header">
          <h2>{__("WDS Example Block with Options")}</h2>
        </header>

        <div className="content-block-content content-block">
          {props.attributes.message}
        </div>
      </section>
    );
  },
  deprecated: [
    {
      attributes: {
        message: {
          type: "array",
          source: "children",
          selector: ".content-block"
        },
        ...BackgroundOptionsAttributes,
        ...TextOptionsAttributes,
        ...OtherOptionsAttributes
      },
      save(props) {
        return (
          <section
            className={classnames(
              props.className,
              ...BackgroundOptionsClasses(props),
              ...OtherOptionsClasses(props)
            )}
            style={{
              ...BackgroundOptionsInlineStyles(props),
              ...TextOptionsInlineStyles(props)
            }}
          >
            {BackgroundOptionsVideoOutput(props)}

            <header className="content-block-header">
              <h2>{__("WDS Example Block with Options")}</h2>
            </header>

            <div className="content-block-content content-block">
              {props.attributes.message}
            </div>
          </section>
        );
      }
    }
  ]
});
index.js;
/**
 * WordPress dependencies
 */
const { __ } = wp.i18n;

const { ColorPalette, description, MediaUpload } = wp.blocks;

const {
  Button,
  Dashicon,
  PanelBody,
  PanelColor,
  PanelRow,
  SelectControl
} = wp.components;

/**
 * Internal dependencies
 */
import BackgroundOptionsAttributes from "./attributes";
import BackgroundOptionsClasses from "./classes";
import BackgroundOptionsInlineStyles from "./inline-styles";
import BackgroundOptionsVideoOutput from "./video";
import "./editor.scss";

// Export for ease of importing in individual blocks.
export {
  BackgroundOptionsAttributes,
  BackgroundOptionsClasses,
  BackgroundOptionsInlineStyles,
  BackgroundOptionsVideoOutput
};

function BackgroundOptions(props) {
  const setBackgroundType = value =>
    props.setAttributes({ backgroundType: value });
  const setBackgroundImage = value =>
    props.setAttributes({ backgroundImage: value });
  const removeBackgroundImage = () =>
    props.setAttributes({ backgroundImage: null });
  const setBackgroundVideo = value =>
    props.setAttributes({ backgroundVideo: value });
  const removeBackgroundVideo = () =>
    props.setAttributes({ backgroundVideo: null });
  const setBackgroundColor = value =>
    props.setAttributes({ backgroundColor: value });

  const imageBackgroundSelect = () => {
    if ("image" !== props.attributes.backgroundType) {
      return "";
    }

    if (!props.attributes.backgroundImage) {
      return (
        <div className="media-upload-wrapper">
          <p>
            <MediaUpload
              buttonProps={{
                className: "components-button button button-large"
              }}
              onSelect={setBackgroundImage}
              type="image"
              value=""
              render={({ open }) => (
                <Button className="button button-large" onClick={open}>
                  <Dashicon icon="format-image" /> {__("Upload Image")}
                </Button>
              )}
            />
          </p>
          <p>
            <description>
              {__("Add/Upload an image file. (1920x1080px .jpg, .png)")}
            </description>
          </p>
        </div>
      );
    }

    return (
      <div className="image-wrapper">
        <p>
          <img
            src={props.attributes.backgroundImage.url}
            alt={props.attributes.backgroundImage.alt}
          />
        </p>
        {props.focus ? (
          <div className="media-button-wrapper">
            <p>
              <Button
                className="remove-image button button-large"
                onClick={removeBackgroundImage}
              >
                <Dashicon icon="no-alt" /> {__("Remove Image")}
              </Button>
            </p>
            <p>
              <description>
                {__("Add/Upload an image file. (1920x1080px .jpg, .png)")}
              </description>
            </p>
          </div>
        ) : null}
      </div>
    );
  };

  const videoBackgroundSelect = () => {
    if ("video" !== props.attributes.backgroundType) {
      return "";
    }

    if (!props.attributes.backgroundVideo) {
      return (
        <div className="media-upload-wrapper">
          <p>
            <MediaUpload
              buttonProps={{
                className: "components-button button button-large"
              }}
              onSelect={setBackgroundVideo}
              type="video"
              value=""
              render={({ open }) => (
                <Button className="button button-large" onClick={open}>
                  <Dashicon icon="format-video" /> {__("Upload Video")}
                </Button>
              )}
            />
          </p>
          <p>
            <description>
              {__(
                "Add/Upload a 1920x1080 .mp4 video file. Note: background videos are only supported on heroes."
              )}
            </description>
          </p>
        </div>
      );
    }

    return (
      <div className="video-wrapper">
        <p>
          <video className="video-container video-container-overlay">
            <source
              type="video/mp4"
              src={props.attributes.backgroundVideo.url}
            />
          </video>
        </p>
        {props.focus ? (
          <div className="media-button-wrapper">
            <p>
              <Button
                className="remove-video button button-large"
                onClick={removeBackgroundVideo}
              >
                <Dashicon icon="no-alt" /> {__("Remove Video")}
              </Button>
            </p>

            <p>
              <description>
                {__(
                  "Add/Upload a 1920x1080 .mp4 video file. Note: background videos are only supported on heroes."
                )}
              </description>
            </p>
          </div>
        ) : null}
      </div>
    );
  };

  const colorPanelSelect = () => {
    if ("color" !== props.attributes.backgroundType) {
      return "";
    }

    return (
      <PanelColor
        title={__("Background Color")}
        colorValue={props.attributes.backgroundColor}
      >
        <ColorPalette
          value={props.attributes.backgroundColor}
          onChange={setBackgroundColor}
        />
      </PanelColor>
    );
  };

  return (
    <PanelBody
      title={__("Background Options")}
      className="wds-background-options"
      initialOpen={false}
    >
      <PanelRow>
        <SelectControl
          key="background-type"
          label={__("Background Type")}
          value={
            props.attributes.backgroundType
              ? props.attributes.backgroundType
              : ""
          }
          options={[
            {
              label: __("None"),
              value: ""
            },
            {
              label: __("Image"),
              value: "image"
            },
            {
              label: __("Video"),
              value: "video"
            },
            {
              label: __("Color"),
              value: "color"
            }
          ]}
          onChange={setBackgroundType}
        />
      </PanelRow>
      <PanelRow>
        {imageBackgroundSelect()}
        {videoBackgroundSelect()}
        {colorPanelSelect()}
      </PanelRow>
    </PanelBody>
  );
}
