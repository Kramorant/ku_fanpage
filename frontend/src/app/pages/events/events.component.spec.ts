import { TestBed } from '@angular/core/testing';
import { EventsComponent } from './events.component';
import { appTestProviders } from '../../testing-setup';

describe('EventsComponent', () => {
  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [EventsComponent],
      providers: [...appTestProviders],
    }).compileComponents();
  });

  it('should create', () => {
    const fixture = TestBed.createComponent(EventsComponent);
    const component = fixture.componentInstance;
    expect(component).toBeTruthy();
  });
});
