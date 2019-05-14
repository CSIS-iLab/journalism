const { RichText, MediaUpload, PlainText, InnerBlocks } = wp.editor;
const { registerBlockType } = wp.blocks;
const { Button } = wp.components;
const { __ } = wp.i18n;
// Import our CSS files
import "./style.scss";
import "./editor.scss";

registerBlockType("jourblocks/dialog", {
  title: "Dialog",
  icon: "format-chat",
  category: "common",
  keywords: [
    __("Dialog", "jourblocks"),
    __("Interview", "jourblocks"),
    __("Conversation", "jourblocks"),
    __("Excerpt", "jourblocks"),
    __("Transcript", "jourblocks"),
    __("Quote", "jourblocks")
  ],
  description: __(
    "Add a block for long quotes, excerpts, interviews, transcripts, or dialog.",
    "jourblocks"
  ),
  attributes: {
    caption: {
      type: "string"
    },
    align: {
      type: "string",
      default: "center"
    }
  },
  supports: {
    align: ["left", "right", "center"]
  },
  edit({ attributes, className, setAttributes }) {
    return (
      <div className="dialog__container">
        <div class="dialog__content">
          <InnerBlocks allowedBlocks={["core/paragraph"]} />
        </div>
        <div className="component__caption">
          <RichText
            onChange={caption => setAttributes({ caption: caption })}
            value={attributes.caption}
            multiline="p"
            placeholder="Dialog Caption"
            formattingControls={["bold", "italic", "underline"]}
            isSelected={attributes.isSelected}
          />
        </div>
      </div>
    );
  },

  save({ attributes }) {
    return (
      <div className="dialog__container">
        <div class="dialog__content">
          <InnerBlocks.Content />
        </div>
        <div className="component__caption">
          <RichText.Content
            tagName="figcaption"
            value={attributes.caption}
            className="dialog__caption"
          />
        </div>
      </div>
    );
  }
});
