import "./style.scss";
import "./editor.scss";

const {
	RichText,
	AlignmentToolbar,
	BlockControls,
  BlockFormatControls,
	MediaUpload,
	PlainText,
	InnerBlocks,
	InspectorControls
} = wp.editor;
const {
	registerBlockType
} = wp.blocks;
const {
	Button
} = wp.components;
const {
	__
} = wp.i18n;
const el = wp.element.createElement;

registerBlockType("jourblocks/definitions", {
  title: "Definition Block",
  icon: "book",
  category: "common",
	keywords: [
		__("Definitions", "jourblocks"),
		__("Dictionary", "jourblocks"),
		__("Define", "jourblocks")
	],
	description: __(
		"Define jargon or vocabulary.",
		"jourblocks"
	),
  attributes: {
    term: {
      type: "string"
    },
    body: {
      type: "string"
    },
		align: {
			type: "string",
			default: "right"
		}
	},
	supports: {
		align: ["right"]
  },

  edit({ attributes, className, setAttributes }) {
		const { term, body, align } = attributes;

    return (
      <div className="definition__container">
				<dl>
					<dt>
        <PlainText
          onChange={content => setAttributes({ term: content })}
          value={attributes.term}
					placeholder="Word"
          className="definition__term"
        />
				</dt>
				<dd>
          <RichText
            onChange={content => setAttributes({ body: content })}
            value={attributes.body}
            multiline="p"
						placeholder="Description"
            formattingControls={["bold", "italic", "underline"]}
            isSelected={attributes.isSelected}
          />
        </dd>
				</dl>
      </div>
    );
  },

  save: ({ attributes }) => {
    //const { term, body, align } = attributes;


    return (
			<div className="definition__container">
			<dl>
          <dt className="definition__term">{attributes.term}</dt>
					<dd>
          <RichText.Content value={attributes.body} /></dd>
					</dl>
					</div>
    );
  }
});
