declare module '@wordpress/blocks' {
  import type { ComponentType } from 'react';

  export type BlockEditProps<TAttributes> = {
    attributes: TAttributes;
    setAttributes: (attributes: Partial<TAttributes>) => void;
  };

  export type BlockConfiguration<TAttributes> = Record<string, unknown> & {
    edit: ComponentType<BlockEditProps<TAttributes>>;
    save?: ComponentType | (() => null);
  };

  export function registerBlockType<TAttributes extends Record<string, unknown>>(
    name: string,
    settings: BlockConfiguration<TAttributes>,
  ): void;
}

declare module '@wordpress/block-editor' {
  import type { ComponentType, HTMLAttributes, ReactNode } from 'react';

  export const InspectorControls: ComponentType<{ children?: ReactNode }>;
  export const URLInputButton: ComponentType<{
    url?: string;
    onChange: (url: string) => void;
  }>;
  export const RichText: ComponentType<{
    tagName: keyof JSX.IntrinsicElements;
    className?: string;
    value?: string;
    placeholder?: string;
    onChange: (value: string) => void;
  }>;
  export function useBlockProps<T extends HTMLAttributes<HTMLElement>>(props?: T): T;
}

declare module '@wordpress/components' {
  import type { ComponentType, ReactNode } from 'react';

  export const Button: ComponentType<{
    children?: ReactNode;
    variant?: 'primary' | 'secondary' | 'tertiary' | 'link';
    onClick?: () => void;
  }>;
  export const PanelBody: ComponentType<{
    children?: ReactNode;
    title: string;
  }>;
  export const SelectControl: ComponentType<{
    label: string;
    value?: string;
    options: Array<{ label: string; value: string }>;
    onChange: (value: string) => void;
  }>;
  export const TextControl: ComponentType<{
    label: string;
    value?: string;
    onChange: (value: string) => void;
  }>;
}
