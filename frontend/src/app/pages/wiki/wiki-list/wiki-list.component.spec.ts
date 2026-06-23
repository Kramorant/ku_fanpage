import { TestBed } from '@angular/core/testing';
import { WikiListComponent } from './wiki-list.component';
import { appTestProviders } from '../../../testing-setup';

describe('WikiListComponent', () => {
  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [WikiListComponent],
      providers: [...appTestProviders],
    }).compileComponents();
  });

  it('should create', () => {
    const fixture = TestBed.createComponent(WikiListComponent);
    const component = fixture.componentInstance;
    expect(component).toBeTruthy();
  });
});
